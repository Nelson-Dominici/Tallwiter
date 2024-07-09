<?php

namespace App\Livewire\Users;

use App\Models\User;

use Livewire\Component;

use Livewire\Attributes\{
    Title,
    Validate
};

use TallStackUi\Traits\Interactions;

#[Title('Create User')]
class Create extends Component
{
    use Interactions;

    #[Validate('bail|required|string|min:3|max:255')]
    public string $name;

    #[Validate('bail|required|string|min:3|max:255|unique:users')]
    public string $email;

    #[Validate('bail|required|string|min:6|max:255')]
    public string $password;

    public function save()
    {
        $validated_body = $this->validate();

        User::create($validated_body);

        $this->toast()->timeout()->success('User Created')->send();

        return $this->redirect('/auth/login', navigate: true);
    }
}
