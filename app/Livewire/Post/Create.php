<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use TallStackUi\Traits\Interactions;

class Create extends Component
{
    use Interactions;
    use WithFileUploads;

    #[Validate('image|nullable|max:9216')]
    public $photo;

    #[Validate('bail|required|string|min:3|max:255')]
    public string $text;

    #[Validate('bail|present|boolean|nullable')]
    public bool $only_followers;

    public function create(): void
    {
        $data = $this->validate();

        $data['user_id'] = auth()->user()->id;

        $data['text'] = nl2br(trim($data['text']));

        if (is_null($data['only_followers'])) {
            $data['only_followers'] = false;
        }

        if ($data['photo']) {
            $data['img_secure_url'] = $data['photo']->storeOnCloudinary()->getSecurePath();
        }

        Post::create($data);

        $this->toast()->success('Post created successfully')->send();

        $this->reset();

        $this->dispatch('post-created');
    }
}
