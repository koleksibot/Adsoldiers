<?php

namespace App\Payment\Advertiser\Domain\Requests;

use App\App\Http\Requests\APIRequest;

class ShowHyperPayTransactionStatusFormRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment_id' => 'required|string',
        ];
    }
}
