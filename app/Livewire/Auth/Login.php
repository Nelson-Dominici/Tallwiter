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

    #[Validate('bail|present|boolean|nullable')]
    public string $remember;

    public function login(): Redirector|RedirectResponse
    {
        $email = $this->validate()['email'];
        $password = $this->validate()['password'];
        $remember = $this->validate()['remember'];

        if (!auth()->attempt(['email' => $email, 'password' => $password], $remember)) {

            $this->addError('email', 'The email or password is incorrect.');
            $this->addError('password', 'The email or password is incorrect.');

            return redirect()->back();
        }

        return redirect()->route('dashboard.home');
    }
}
