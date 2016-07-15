<?php namespace Modules\Accounting\Http\Requests;

use App\Http\Requests\Request;

class TransactionRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'amount' 	  => 'required|numeric',
			'date'    	  => 'required',
			'category_id' => 'required',
			'account_id'  => 'required',
		];
	}

}
