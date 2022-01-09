<?php

namespace App\Payment\Admin\Domain\Requests;

use App\App\Http\Requests\APIRequest;

class ConvertTransactionToDoneFormRequest extends APIRequest
{

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'transNumber' => 'required|min:1|integer',
		];
	}
}
