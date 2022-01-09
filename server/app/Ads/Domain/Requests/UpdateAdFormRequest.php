<?php

namespace App\Campaigns\Domain\Requests;

use App\App\Http\Requests\APIRequest;

class UpdateAdFormRequest extends APIRequest
{
    public function authorize()
    {
        return (
            auth()->user()->can('update-ad')
            && (request()->ad->campaign->owner->id == auth()->user()->id)
        );
    }
    public function rules()
    {
        $campaignType = request()->get('campaign_type');
        $rules = [
            'title' => 'max:255|unique:ads,title',
            'content' => 'min:10|max:255',
            'country' => 'sometimes',
            'country.*' => 'exists:countries,country',
            'city' => 'sometimes',
            'city.*' => 'exists:cities,city',
            'language' => 'sometimes',
            'language.*' => 'exists:languages,value',
            'media_type' => request()->media ? 'sometimes|in:image,video,slider' : 'sometimes',
            'age' => 'sometimes',
            'age.*' => 'in:25-34,35-44,45-54',
            'gender' => 'sometimes|in:male,female,both',
            'targeted_audience' => 'sometimes',
            'call_of_action_txt' => 'sometimes|max:255',
            'call_of_action_url' => 'sometimes|max:255',
            'campaign_id' => 'sometimes|exists:campaigns,id|integer',
            'media' => request()->media ? 'required' : 'sometimes',
        ];

        // merge the media validation according to it's type wether it's video or image
    
        // Video
        if (request()->media_type == 'video') {
            $rules = array_merge(
                $rules,
                [
                    'media.*' => 'required|file|max:50000|mimes:mp4'
                ]
            );

            return $rules;
        }

        // Image
        $rules = array_merge(
            $rules,
            [
                'media.*' => 'file|dimensions:min_width=100,min_height=200|max:2048|mimes:jpg,jpeg,png',
            ]
        );
         
        return $rules;
    }
}
