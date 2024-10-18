<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;

#[Title('Home')]
class Index extends Component
{
    #[On('post-created')]
    public function render(Request $request): View
    {
        $userId = auth()->user()->id;

        $query = Post::with('user')
            ->leftJoin('posts_likes', 'posts.id', '=', 'posts_likes.post_id')
            ->leftJoin('bookmarks', 'posts.id', '=', 'bookmarks.post_id')
            ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
            ->select('posts.*',
                    DB::raw("SUM(posts_likes.user_id = {$userId}) AS liked"),
                    DB::raw("COUNT(DISTINCT posts_likes.id) AS likes_count"),
                    DB::raw("COUNT(DISTINCT comments.id) AS comments_count"),
                    DB::raw("SUM(bookmarks.user_id = {$userId}) AS marked"))
            ->groupBy('posts.id')
            ->orderBy('posts.created_at', 'desc');

        $selectedFilter = 'for-you';

        $previousRouteQuery = parse_url(URL::previous(), PHP_URL_QUERY);

        if (
            $request->input('filter') == 'following' ||
            (
                $previousRouteQuery == 'filter=following' &&
                $request->path() == 'livewire/update'
            )
        ) {
            $selectedFilter = 'following';
            $query->where('only_followers', 1);
        }

        $posts = $query->simplePaginate(6);

        return view('livewire.post.index', compact('posts', 'selectedFilter'));
    }
}