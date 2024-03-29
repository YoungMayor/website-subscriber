<?php

namespace App\Actions\User;

use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\User;
use App\Notifications\Auth\RegistrationSuccess;

class OnboardUser
{
    /**
     * Create a new class instance.
     */
    public function __invoke(
        string $email,
        string $password,
        string $username,
        ?string $fullName = null
    ): User {
        $user = $this->createUser($email, $password, $username, $fullName);

        $this->sendWelcomeEmail($user);

        return $user;
    }

    private function createUser(
        string $email,
        string $password,
        string $username,
        ?string $fullName
    ): User {
        return User::create([
            'email' => $email,
            'password' => $password,
            'username' => $username,
            'full_name' => $fullName,
        ]);
    }

    private function sendWelcomeEmail(User $user): void
    {
        $user->notify(new RegistrationSuccess());
    }

    public static function fromRequest(RegistrationRequest $request): User
    {
        return (new self)(
            $request->email,
            $request->password,
            $request->username,
            $request->full_name
        );
    }
}
