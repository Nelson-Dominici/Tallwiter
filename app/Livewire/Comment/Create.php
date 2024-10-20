<?php

namespace App\Livewire\Comment;

use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Validate;
use TallStackUi\Traits\Interactions;

class Create extends Component
{
    #[Validate('bail|required|string|max:255')]
    public string $text;

    public Post $post;

    use Interactions;

    public function create(): void
    {
        $body = [
            'post_id' => $this->post->id,
            'user_id' => auth()->user()->id,
            'text' => $this->validate()['text']
        ];

        $comment = Comment::create($body);

        if ($this->post->user_id !== auth()->user()->id) {

            Notification::create([
                'type' => 'comment',
                'image' => auth()->user()->profile_photo_id,
                'sender_id' => auth()->user()->id,
                'user_id' => $this->post->user_id,
                'text' => $this->validate()['text'],
                'title' => auth()->user()->name.' commented on your post',
            ]);

        }

        $this->reset(['text']);

        $this->dispatch('comment-created.'.$this->post->id, comment: $comment);
    }
}
