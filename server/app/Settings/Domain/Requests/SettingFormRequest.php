<?php

namespace App\Settings\Domain\Requests;

use App\App\Http\Requests\APIRequest;

class SettingFormRequest extends APIRequest {
	/**
	 * Determine if user is authorized to ado this request
	 * @return bool
	 */
	public function authorize() {
		return auth()->user()->can('update-settings');
	}
	/**
	 * Get the Validation Rules that Applies to the Request
	 */
	public function rules() {
		return [
			'about_us' => 'string|min:20|max:3000',
			'vision' => 'string|min:20|max:3000',
			'mission' => 'string|min:20|max:3000',
			'about_us_image' => 'nullable|file|dimensions:min_width=100,min_height=200|max:2048|mimes:jpg,jpeg,png',
			'mission_image' => 'nullable|file|dimensions:min_width=100,min_height=200|max:2048|mimes:jpg,jpeg,png',
			'vision_image' => 'nullable|file|dimensions:min_width=100,min_height=200|max:2048|mimes:jpg,jpeg,png',
			'terms' => 'string|min:20|max:3000',
			'privacy' => 'string|min:20|max:3000',
			'intro_video' => 'url',
			'email' => 'email',
			'address' => 'string|min:10|max:200',
			'mobile' => 'numeric',
			'lat' => 'numeric',
			'lng' => 'numeric',
			'facebook' => 'string|min:10|max:1000',
			'instagram' => 'string|min:10|max:1000',
			'twitter' => 'string|min:10|max:1000',
			'campaign_min_Duration' => 'integer',
			'campaign_min_budget' => 'integer',
			'ad_min_budget' => 'integer',
			'task_min_click_price' => 'integer',
		];
	}
}