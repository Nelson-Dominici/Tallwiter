<?php

namespace App\Livewire\Dashboard;

use App\Models\Post;

use Livewire\Component;

use Livewire\Attributes\{
    Title,
    Validate
};

use Illuminate\Http\Request;

use Livewire\WithFileUploads;

use TallStackUi\Traits\Interactions;

#[Title('Home')]
class Home extends Component
{
    use Interactions;
    use WithFileUploads;

    #[Validate('image|nullable|max:9216')]
    public $photo;

    #[Validate('bail|required|string|min:3|max:255')]
    public string $text;

    #[Validate('bail|present|boolean|nullable')]
    public bool $only_followers;

    public function render(Request $request)
    {
        $query = Post::with('user');

        if (request('filter') == 'following') {
            $query
                ->where('only_followers', 1)
                ->where('user_id', '!==', auth()->user()->id);
        } else {
            $query->where('only_followers', 0);
        }

        $posts = $query->cursorPaginate(5);

        return view('livewire.dashboard.home', compact('posts'));
    }

    public function savePost()
    {
        $data = $this->validate();

        $data['user_id'] = auth()->user()->id;

        $data['text'] = nl2br(trim($data['text']));

        if (is_null($data['only_followers'])) {
            $data['only_followers'] = false;
        }

        if ($data['photo']) {

            $data['img_secure_url'] = $data['photo']->storeOnCloudinary()->getSecurePath();
        }

        Post::create($data);

        $this->toast()->success('Post created successfully')->send();

        $this->reset(['text', 'photo', 'only_followers']);
    }
}
