<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\ApiResponses;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Console\ExceptionMakeCommand;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    use ApiResponses;
    /**
     * Register a new user
     *
     * @param  App\Http\Requests\ApiRegisterRequest $request
     * @return  \Illuminate\Http\JsonResponse
     */
    public function register(ApiRegisterRequest $request): JsonResponse
    {
        $request->validated($request->all());

        $user = User::create($request->all());

        return $this->created(
            'User registered with success',
            [
                'user' => $user,
                'token' => $user->createToken('API token for ' . $user->email)->plainTextToken
            ]
        );
    }

    /**
     * Login a user and return a token for API auth
     *
     * @param  App\Http\Requests\ApiLoginRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(ApiLoginRequest $request): JsonResponse
    {
        $request->validated($request->all());

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw new AuthenticationException();
        }

        $user = User::firstWhere('email', $request->email);

        return $this->ok(
            'Authenticated',
            [
                'token' => $user->createToken('API token for ' . $user->email)->plainTextToken
            ]
        );
    }
}
