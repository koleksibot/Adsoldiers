<?php

namespace App\Contact\Domain\Requests;

use App\App\Http\Requests\APIRequest;

class EncryptPaymentFormRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'txnid' => 'required',
            'amount' => 'required',
            'surl' => 'required',
            'currency' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'addr1' => 'required',
            'addr2' => 'sometimes',
            'city' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'country' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            // 'name' => 'required|min:4|max:40|string',
            // 'email' => 'required|email',
            // 'subject' => 'required|min:4|max:40|string',
            // 'message' => 'required|min:4|max:5000',
        ];
    }
}
