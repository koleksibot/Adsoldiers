<?php

namespace App\Users\Domain\Requests;

use App\App\Http\Requests\APIRequest;

class RegisterUserFormRequest extends APIRequest
{
    public function rules()
    {
        return [
            'username' => 'required|min:6|max:32|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|max:32|confirmed',
            'company' => 'min:6|max:32|string|nullable',
            'picture' => 'required|file|dimensions:min_width=200,min_height=200|max:2048|mimes:jpg,jpeg,png',
        ];
    }
}
