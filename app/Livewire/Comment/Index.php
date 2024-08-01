<?php

namespace App\Livewire\Comment;

use Livewire\Attributes\Validate;
use Illuminate\View\View;
use App\Models\Comment;
use Livewire\Component;
use App\Models\Post;

class Index extends Component
{
    #[Validate('bail|required|string|min:3|max:255')]
    public string $text;

    public Post $post;

    public function create(): void
    {
        $body = [
            'post_id' => $this->post->id,
            'user_id' => auth()->user()->id,
            'text' => $this->validate()['text']
        ];

        Comment::create($body);

        $this->reset(['text']);
    }

    public function render(): View
    {
        $comments = Comment::all()->where('post_id','=', $this->post->id);

        return view('livewire.comment.index', compact('comments'));
    }
}
