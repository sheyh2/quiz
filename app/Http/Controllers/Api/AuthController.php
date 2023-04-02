<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    public function signIn(LoginRequest $request)
    {
        /** @var User|null $user */
        $user = User::getInstance()
            ->getUser($request->input('email'));

        if (is_null($user) || !Hash::check($request->input('password'), $user->getPassword())) {
            $this->status = false;
            $this->code = 404;
            $this->message = 'User not found!';

            return $this->composeJson();
        }

        $user->update([
            'token' => sha1($user->getEmail())
        ]);
        return $this->composeJson([['token' => $user->getToken()]]);
    }

    public function signUp(SignUpRequest $request)
    {
        /** @var User|null $user */
        $user = User::getInstance()->create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'token' => sha1($request->input('email')),
        ]);

        return $this->composeJson([['token' => $user->getToken()]]);
    }
}
