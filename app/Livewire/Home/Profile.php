<?php

namespace App\Livewire\Home;

use Livewire\Component;
use Livewire\WithFileUploads;

use Livewire\Attributes\{
    Title,
    Validate
};

#[Title('Profile')]
class Profile extends Component
{
    use WithFileUploads;

    #[Validate('bail|required|string|min:3|max:255')]
    public string $name;

    #[Validate('image|max:1024')]
    public string $photo;

    #[Validate('bail|string|min:3|max:255')]
    public string $description;

    public function update()
    {

    }
}
