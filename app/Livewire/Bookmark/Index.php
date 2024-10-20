<?php

namespace App\Livewire\Bookmark;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Bookmark')]
class Index extends Component
{
    public function render()
    {
        $userId = auth()->user()->id;

        $query = Post::with('user')
            ->leftJoin('posts_likes', 'posts.id', '=', 'posts_likes.post_id')
            ->join('bookmarks', function($join) use ($userId) {
                $join->on('posts.id', '=', 'bookmarks.post_id')
                    ->where('bookmarks.user_id', '=', $userId); // Condição para filtrar por $userId
            })
            ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
            ->select('posts.*',
                    DB::raw("SUM(posts_likes.user_id = $userId) AS liked"),
                    DB::raw("COUNT(DISTINCT posts_likes.id) AS likes_count"),
                    DB::raw("COUNT(DISTINCT comments.id) AS comments_count"),
                    DB::raw("SUM(bookmarks.user_id = $userId) AS marked"))
            ->groupBy('posts.id')
            ->orderBy('posts.created_at', 'desc');

        $posts = $query->get();

        return view('livewire.bookmark.index', compact('posts'));
    }
}
