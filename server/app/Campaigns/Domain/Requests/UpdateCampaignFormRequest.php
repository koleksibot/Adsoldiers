<?php

namespace App\Campaigns\Domain\Requests;

use App\App\Http\Requests\APIRequest;

class UpdateCampaignFormRequest extends APIRequest
{
    public function authorize()
    {
        return auth()->user()->can('update-campaign');
    }
    public function rules()
    {
        return [
            'title' => 'required|nullable|max:255|unique:campaigns,title',
        ];
    }
}
