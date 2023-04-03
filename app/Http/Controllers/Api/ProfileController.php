<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangeInfoRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends ApiController
{
    public function getMe(Request $request)
    {
        return $this->composeJson(new UserResource($this->user));
    }

    public function changeInfo(ChangeInfoRequest $request)
    {
        $this->user->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
        ]);

        return $this->composeJson(new UserResource($this->user));
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        if (!Hash::check($request->input('oldPassword'), $this->user->getPassword())) {
            $this->status = false;
            $this->code = 401;
            $this->message = 'Incorrect old password';

            return $this->composeJson();
        }

        $this->user->update(['password' => Hash::make($request->input('password'))]);
        return $this->composeJson();
    }
}
