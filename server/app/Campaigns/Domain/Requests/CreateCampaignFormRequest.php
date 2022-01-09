<?php

namespace App\Campaigns\Domain\Requests;

use App\App\Http\Requests\APIRequest;

class CreateCampaignFormRequest extends APIRequest
{
    public function authorize()
    {
        return auth()->user()->can('create-campaign');
    }
    public function rules()
    {
        return [
            'company_id' => 'sometimes|exists:companies,id|integer',
            'title' => 'required|max:255|unique:campaigns,title',
            'type' => 'required|in:awareness,traffic,app-installs,video-views,messages,lead-generation',
            // 'description' => 'required|min:10|max:255',
            // 'content' => 'required|min:10|max:5000',
            // 'industry' => 'required',
            // 'budget' => 'required|numeric',
            // 'location' => 'required|string|max:255',
            // 'end_date' => 'required|date_format:"Y-m-j"',
            // 'start_date' => 'required|date_format:"Y-m-j"',
            // 'daily_budget' => 'required|numeric',
        ];
    }
    public function validated()
    {
        return array_merge(
            parent::validated(),
            [
             'company_id' => $this->request->get('company_id') ?? auth()->user()->company->id,
            ]
        );
    }
}
