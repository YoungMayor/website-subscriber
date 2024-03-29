<?php

namespace App\Http\Controllers\API;

use App\Actions\User\OnboardUser;
use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Notifications\Auth\LoginSuccessful;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return apiResponse(StatusCode::UNAUTHORIZED, 'auth.failed');
        }

        $token = $request->user()->createToken(
            $request->header('user-agent', 'Application')
        );

        $request->user()->notify(new LoginSuccessful($token->accessToken));

        return apiResponse(StatusCode::OK, 'auth.success', [
            'token' => $token->plainTextToken,
        ]);
    }

    public function register(RegistrationRequest $request, OnboardUser $onboardUser)
    {
        $user = $onboardUser->fromRequest($request);

        $token = $user->createToken('Newly registered account');

        return apiResponse(StatusCode::OK, 'auth.registration.success', [
            'token' => $token->plainTextToken,
        ]);
    }
}
