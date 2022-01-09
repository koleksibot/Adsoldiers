<?php

namespace App\Libraries\Domain\Requests;

use App\App\Http\Requests\APIRequest;

class CreateLibraryFormRequest extends APIRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return auth()->user()->can('create-library');
	}
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		$rules = [
			'title' => 'required|min:6|max:32|string|unique:libraries,title',
			'description' => 'required|min:10|max:255',
			'category' => 'required|in:Entertainment,Sport,Beauty & Body Care,Business & Management,News,Food & Drinks,Kids,Cars & Vehicles,Technology,Games,Home & Garden,Travelling,Health',
			'media' => 'required',
		];
		if ($this->hasFile('media')) {
			return $rules = array_merge(
				$rules,
				[
					'media.*' => 'file|dimensions:min_width=100,min_height=200|max:2048|mimes:jpg,jpeg,png',
				]
			);
		}

		return $rules;

	}
	/**
	 * Custome error message for the uploaded media
	 */
	public function messages() {
		return [
			'media.*.max' => 'Media files size can\'t exceeds 10 MB ',
		];
	}
}
