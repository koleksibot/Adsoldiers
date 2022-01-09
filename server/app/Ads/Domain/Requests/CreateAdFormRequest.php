<?php

namespace App\Ads\Domain\Requests;

use App\App\Http\Requests\APIRequest;

class CreateAdFormRequest extends APIRequest
{
    public function authorize()
    {
        return auth()->user()->can('create-ad');
    }

    public function rules()
    {
        $campaignType = request()->get('campaign_type');
        $rules = [
            'title' => 'required|max:255|unique:ads,title',
            'content' => 'required|min:10|max:255',
            'country' => 'required',
            'country.*' => 'exists:countries,country',
            'city' => 'required',
            'city.*' => 'exists:cities,city',
            'language' => 'required',
            'language.*' => 'exists:languages,value',
            'start_date' => 'required|date_format:"Y-m-d"',
            'end_date' => 'required|date_format:"Y-m-d"',
            'budget' => 'required|numeric|digits_between:1,5',
            'media' => 'required',
            'media_type' => 'required|in:image,video,slider',
            'age' => 'required',
            'age.*' => 'in:25-34,35-44,45-54',
            'gender' => 'required|in:male,female,both',
            'targeted_audience' => 'required',
            'call_of_action_txt' => 'sometimes|max:255',
            'call_of_action_url' => 'sometimes|max:255',
            'campaign_id' => 'required|exists:campaigns,id|integer',
        ];

        // merge the media validation according to it's type wether it's video or image

        // Video
        if (request()->media_type == 'video'
            || (request()->media
            && (head(request()->media))->getClientOriginalExtension() == 'mp4')
        ) {
            $rules = array_merge(
                $rules,
                [
                    'media.*' => 'required|file|max:5000|mimes:mp4'
                ]
            );

            return $rules;
        }

        // Image
        $rules = array_merge(
            $rules,
            [
                'media.*' => 'file|dimensions:min_width=200,min_height=200|max:2048|mimes:jpg,jpeg,png',
            ]
        );

        return $rules;
    }
}
