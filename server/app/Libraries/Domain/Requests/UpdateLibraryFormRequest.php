<?php

namespace App\Libraries\Domain\Requests;

use App\App\Http\Requests\APIRequest;

class UpdateLibraryFormRequest extends APIRequest {
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
			'category' => 'required|min:3|max:255',
			'media' => 'required',
		];
		if ($this->hasFile('media')) {
			if (request()->media[0]->getClientOriginalExtension() == 'mp4') {
				return $rules = array_merge($rules, ['media.*' => 'file|max:100000|mimes:mp4']);
			} else {
				return $rules = array_merge(
					$rules,
					[
						'media.*' => 'file|dimensions:min_width=100,min_height=200|max:2048|mimes:jpg,jpeg,png',
					]
				);
			}
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
