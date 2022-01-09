<?php

namespace App\Users\Domain\Requests;

use App\App\Http\Requests\APIRequest;

class CreateUserFormRequest extends APIRequest
{
    public function authorize()
    {
        return auth()->user()->can('create-user');
    }
    public function rules()
    {
        return [
            'username' => 'required|min:6|max:32|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|max:32|confirmed',
            'company' => $this->request->get('slug') == 'Advertiser' ? 'required|string|min:6|max:32' : '',
            // role slug.
            'slug' => [
                'required',
                'exists:roles,slug',
            ],
        ];
    }
}
