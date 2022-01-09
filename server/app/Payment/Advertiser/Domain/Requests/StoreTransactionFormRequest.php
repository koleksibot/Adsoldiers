<?php

namespace App\Payment\Advertiser\Domain\Requests;

use App\App\Http\Requests\APIRequest;

class StoreTransactionFormRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'amount' => 'required|numeric|digits_between:1,5',
        ];

        if (auth()->user()->roles()->first()->slug === 'advertiser') {
            return $rules = array_merge(
                $rules,
                [
                    'ad_id' => 'required|numeric|exists:ads,id',
                    'status' => 'required|string|in:pending,done,canceled',
                ]
            );
        }

        return $rules;
    }
}
