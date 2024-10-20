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
        $comment['name'] = auth()->user()->name;
        $comment['profile_photo_id'] = auth()->user()->profile_photo_id;

        $this->comments[] = $comment;
    }

    public function mount(): void
    {
        $userId = auth()->user()->id;

        $query = Comment::where('comments.post_id', $this->post->id)
        ->leftJoin('comments_likes', 'comments.id', '=', 'comments_likes.comment_id')
        ->join('users', 'comments.user_id', '=', 'users.id')
        ->select('comments.*',
                 'users.name',
                 'users.profile_photo_id',
                 DB::raw("COUNT(IF(comments_likes.user_id = {$userId}, comments_likes.comment_id, NULL)) AS liked"),
                 DB::raw("COUNT(comments_likes.comment_id) AS likes_count"))
        ->groupBy('comments.id', 'users.name')
        ->orderBy('comments.created_at', 'asc');

        $this->comments = $query->get()->toArray();
    }

    public function render(): View
    {
        return view('livewire.comment.index');
    }
}
