<?php

namespace App\Livewire\Comment;

use App\Models\Comment;
use Livewire\Component;
use Livewire\Attributes\Validate;
use TallStackUi\Traits\Interactions;

class Create extends Component
{
    #[Validate('bail|required|string|min:3|max:255')]
    public string $text;

    public $post;

    use Interactions;

    public function create(): void
    {
        $body = [
            'post_id' => $this->post->id,
            'user_id' => auth()->user()->id,
            'text' => $this->validate()['text']
        ];

        Comment::create($body);

        $this->reset(['text']);

        $this->toast()->success('Comment added successfully')->send();

        $this->dispatch('comment-created');
    }
}
