<?php

namespace App\Analytics\Domain\Requests;

use App\App\Http\Requests\APIRequest;

class AnalyticFormRequest extends APIRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_utm' => 'sometimes|exists:users,utm',
            'ad_id' => 'sometimes|exists:ads,title'
        ];
    }
}
