<?php

namespace App\Livewire\Components;

use App\Models\Comment as ModelsComment;
use App\Models\Post;
use Livewire\Component;
use App\Models\CommentsLike;

class Comment extends Component
{
    public int $liked;
    public Post $post;
    public $comment;
    public int $likes_count;

    public string $name;
    public ?string $profile_photo_id;

    public function mount(): void
    {
        $this->liked = $this->comment['liked'];
        $this->name = $this->comment['name'];
        $this->likes_count = $this->comment['likes_count'];
        $this->profile_photo_id = $this->comment['profile_photo_id'];
    }

    public function handleLike(): void
    {
        $body = ['user_id' => auth()->user()->id, 'post_id' => $this->post->id, 'comment_id' => $this->comment['id']];

        $result = CommentsLike::where($body)->delete();

        if (!$result) {

            CommentsLike::create($body);

            $this->liked = 1;
            $this->likes_count++;
            return;
        }

        $this->liked = 0;
        $this->likes_count--;
    }

    public function delete(): void
    {
        ModelsComment::find($this->comment['id'])->delete();

        $this->dispatch('comment-deleted.'.$this->post->id);
    }
}
