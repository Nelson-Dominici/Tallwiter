<?php

namespace App\Livewire\Components;

use App\Models\Follower;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RightBar extends Component
{
    public Collection $users;
    public ?Post $hyped_post = null;

    public function render(): View
    {

        $userId = Auth::id();

        $this->users = User::whereNotIn('id', function($query) use ($userId) {
            $query->select('following')
                  ->from('followers')
                  ->where('user', $userId);
        })
        ->where('id', '!=', $userId)
        ->take(3)
        ->get()
        ->map(function($user) {
            $user->following = false;
            return $user;
        });

        $hyped_post_id = DB::table('posts_likes')
            ->select('post_id', DB::raw('COUNT(*) as occurrences'))
            ->whereDate('created_at', Carbon::today())
            ->groupBy('post_id')
            ->orderByDesc('occurrences')
            ->first();

        if ($hyped_post_id) {

            $this->hyped_post = Post::find($hyped_post_id->post_id)
            ->leftJoin('posts_likes', 'posts.id', '=', 'posts_likes.post_id')
            ->leftJoin('bookmarks', 'posts.id', '=', 'bookmarks.post_id')
            ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
            ->select('posts.*',
                    DB::raw("SUM(posts_likes.user_id = {$userId}) AS liked"),
                    DB::raw("COUNT(DISTINCT posts_likes.id) AS likes_count"),
                    DB::raw("COUNT(DISTINCT comments.id) AS comments_count"),
                    DB::raw("SUM(bookmarks.user_id = {$userId}) AS marked"))
            ->groupBy('posts.id')
            ->orderBy('posts.created_at', 'desc')
            ->first();

        }

        return view('livewire.components.right-bar');
    }

    public function followHandle($user)
    {
        User::where('id', $user['id'])->update(['notification' => true]);
        Follower::create(['user' => auth()->user()->id, 'following' => $user['id']]);
    }
}
