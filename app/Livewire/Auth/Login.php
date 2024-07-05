<?php

namespace App\Livewire\Auth;

use Livewire\Component;

use Livewire\Attributes\{
    Title,
    Validate
};

use Illuminate\Http\RedirectResponse;

use Livewire\Features\SupportRedirects\Redirector;

#[Title('Login')]
class Login extends Component
{
    #[Validate('bail|required|string|min:3|max:255')]
    public string $email;

    #[Validate('bail|required|string|min:6|max:255')]
    public string $password;

    public function login(): Redirector|RedirectResponse
    {
        if (!auth()->attempt($this->validate())) {

            $this->addError('Incorrect Credentials', 'The email or password is incorrect.');

            return redirect()->back();
        }

        return redirect()->route('home.dashboard');
    }
}
