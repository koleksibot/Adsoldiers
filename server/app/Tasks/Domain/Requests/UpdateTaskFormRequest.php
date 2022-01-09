<?php

namespace App\Tasks\Domain\Requests;

use App\App\Http\Requests\APIRequest;

class UpdateTaskFormRequest extends APIRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return auth()->user()->can('update-task');
	}
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		$rules = [
			'title' => 'min:6|max:32|string',
			'description' => 'min:10|max:255',
			'content' => 'min:10|max:5000',
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
