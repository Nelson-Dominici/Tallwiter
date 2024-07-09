<?php

namespace App\Livewire\Auth;

use Livewire\Component;

use Livewire\Attributes\{
    Title,
    Validate
};

use Illuminate\Http\RedirectResponse;

use TallStackUi\Traits\Interactions;

#[Title('Login')]
class Login extends Component
{
    use Interactions;

    #[Validate('bail|required|string|min:3|max:255')]
    public string $email;

    #[Validate('bail|required|string|min:6|max:255')]
    public string $password;

    #[Validate('bail|present|boolean|nullable')]
    public string $remember;

    public function login(): null|RedirectResponse
    {
        $validated_body = $this->validate();

        $email = $validated_body['email'];
        $password = $validated_body['password'];
        $remember = $validated_body['remember'];

        if (!auth()->attempt(['email' => $email, 'password' => $password], $remember)) {

            $this->addError('email', 'The email or password is incorrect.');
            $this->addError('password', 'The email or password is incorrect.');

            return redirect()->back();
        }

        $this->toast()->success('User logged in successfully')->send();

        return $this->redirect('/home', navigate: true);
    }
}
