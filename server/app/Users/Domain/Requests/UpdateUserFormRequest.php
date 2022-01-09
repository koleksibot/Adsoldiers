<?php

namespace App\Users\Domain\Requests;

use App\App\Http\Requests\APIRequest;
use App\Users\Domain\Rules\CheckPassword;

class UpdateUserFormRequest extends APIRequest
{
    public function rules()
    {
        return [
            'username' => 'sometimes|min:6|max:32|string|unique:users,username',
            'address' => 'sometimes|min:6|max:32|string',
            'mobile' => 'sometimes|min:6|max:15|string',
            'current_password' => $this->password ? ['required', 'string', new CheckPassword] : '',
            'password' => 'string|min:8|max:32|confirmed',
            'picture' => 'file|dimensions:min_width=200,min_height=200|max:2048|mimes:jpg,jpeg,png',
        ];
    }
}
