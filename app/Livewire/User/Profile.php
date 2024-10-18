<?php

namespace App\Livewire\User;

use App\Models\Follower;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

use Livewire\Attributes\{
    Title,
    Validate
};

use Livewire\WithFileUploads;

#[Title('Profile')]
class Profile extends Component
{
    use WithFileUploads;

    public bool $modal;

    public int $profileUserId;

    public $posts_page = 3;

    public $following = false;

    public string $email;
    public string $created_at;
    public null|string $banner_photo_id = null;
    public null|string $profile_photo_id = null;

    #[Validate('bail|required|string|min:3|max:255')]
    public string $name;

    #[Validate('bail|string|min:3|max:255')]
    public null|string $description = null;

    #[Validate('bail|image|nullable|max:9216')]
    public $profilePhoto;

    #[Validate('bail|image|nullable|max:9216')]
    public $bannerPhoto;

    public function mount(string $userId): void
    {
        $user = auth()->user();

        if($user->id !== $userId) {
            $user = User::find($userId);
            $this->following = Follower::find($userId);
        }

        $this->profileUserId = $user->id;

        $this->fill(
            $user->only('name','email','description','banner_photo_id','profile_photo_id','created_at'),
        );
    }

    function render()
    {
        $userId = auth()->user()->id;

        $query = Post::with('user')
        ->leftJoin('posts_likes', 'posts.id', '=', 'posts_likes.post_id')
        ->join('bookmarks', 'posts.id', '=', 'bookmarks.post_id')  // Alterado para INNER JOIN
        ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
        ->select('posts.*',
                 DB::raw("SUM(posts_likes.user_id = $userId) AS liked"),
                 DB::raw("COUNT(DISTINCT posts_likes.id) AS likes_count"),
                 DB::raw("COUNT(DISTINCT comments.id) AS comments_count"),
                 DB::raw("SUM(bookmarks.user_id = $userId) AS marked"))
        ->groupBy('posts.id')
        ->orderBy('posts.created_at', 'desc');


        $posts = $query->get();

        return view('livewire.user.profile', compact('posts'));
    }

    public function save(): void
    {
        $data = $this->validate();

        if ($data['profilePhoto']) {
            $profilePublicId = $data['profilePhoto']->storeOnCloudinary()->getPublicId();
            $data['profile_photo_id'] = $profilePublicId;
            $this->profile_photo_id = $profilePublicId;
        }

        if ($data['bannerPhoto']) {
            $bannerPublicId = $data['bannerPhoto']->storeOnCloudinary()->getPublicId();
            $data['banner_photo_id'] = $bannerPublicId;
            $this->banner_photo_id = $bannerPublicId;
        }

        auth()->user()->update($data);

        $this->modal = false;
    }

    public function follow(): void
    {
        Follower::create([
            'user' => auth()->user()->id,
            'following' => $this->profileUserId
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return $this->redirect('/auth/login', navigate: true);
    }

    public function delete()
    {
        auth()->user()->delete();

        return $this->redirect('/auth/login', navigate: true);
    }
}
