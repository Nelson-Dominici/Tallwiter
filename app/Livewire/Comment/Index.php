<?php

namespace App\Livewire\Comment;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Illuminate\View\View;
use App\Models\Comment;
use Livewire\Component;
use App\Models\Post;

class Index extends Component
{
    public Post $post;
    public array $comments;

    #[On('comment-created.{post.id}')]
    public function addComment($comment)
    {
        $comment['liked'] = 0;
        $comment['likes_count'] = 0;

        $this->comments[] = $comment;
    }

    public function mount(): void
    {
        $userId = auth()->user()->id;

        $query = Comment::where('comments.post_id', $this->post->id)
            ->leftJoin('comments_likes', 'comments.id', '=', 'comments_likes.comment_id')
            ->select('comments.*',
                    DB::raw("COUNT(IF(comments_likes.user_id = {$userId}, comments_likes.comment_id, NULL)) AS liked"),
                    DB::raw("COUNT(comments_likes.comment_id) AS likes_count"))
            ->groupBy('comments.id')
            ->orderBy('comments.created_at', 'asc');

        $this->comments = $query->get()->toArray();
    }

    public function render(): View
    {
        return view('livewire.comment.index');
    }
}
