<?php

namespace App\Livewire\Components;

use App\Models\PostsLike;
use Livewire\Component;
use App\Models\Bookmark;
use App\Models\Post as ModelsPost;
use Livewire\Attributes\On;
use TallStackUi\Traits\Interactions;

class Post extends Component
{
    use Interactions;

    public null|int $liked;
    public null|int $marked;
    public int $likes_count;
    public int $comments_count;
    public ModelsPost $post;

    public function delete(): void
    {
        ModelsPost::where('id', $this->post->id)->delete();

        $this->dispatch('post-created');
    }

    public function mount(ModelsPost $post): void
    {
        $this->fill(
            $post->only('liked', 'marked','likes_count','comments_count')
        );
    }

    public function handleBookMarke(): void
    {
        $body = ['user_id' => auth()->user()->id, 'post_id' => $this->post->id];

        $result = Bookmark::where($body)->delete();

        if (!$result) {
            Bookmark::create($body);

            $this->toast()->success('Post marked successfully')->send();
        }

        $this->marked = !$result ? 1 : 0;
    }

    public function handleLike(): void
    {
        $body = ['user_id' => auth()->user()->id, 'post_id' => $this->post->id];

        $result = PostsLike::where($body)->delete();

        if (!$result) {

            PostsLike::create($body);

            $this->liked = 1;
            $this->likes_count++;
            return;
        }

        $this->liked = 0;
        $this->likes_count--;
    }

    #[On('comment-created.{post.id}')]
    public function incrementCommentsCount(): void
    {
        $this->comments_count++;
    }

    #[On('comment-deleted.{post.id}')]
    public function decrementCommentsCount(): void
    {
        $this->comments_count--;
    }
}
