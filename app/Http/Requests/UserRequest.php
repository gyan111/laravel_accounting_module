<?php namespace Modules\Accounting\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request {

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
		if ($this->method() == 'PUT') {
			return [
				'first_name' => 'required',
				'last_name' 	=> 'required',
				'email'    	=> 'required|email|unique:users,email,' . $this->id,
				'phone'  	=> 'required',
				'password'	=> 'alphaNum|min:3|confirmed',
				'image'     => 'image|mimes:jpeg,jpg,bmp,png,gif',
			];

		} else {
			return [
				'first_name' 	   	    => 'required',
				'last_name' 	    	    => 'required',
				'email'    	 			=> 'required|email|unique:users',
				'phone'  	 	  		=> 'required',
				'password'	 	  		=> 'required|alphaNum|min:3|confirmed',
				'password_confirmation' => 'required',
				'image'            		=> 'image|mimes:jpeg,jpg,bmp,png,gif',
			];
		}
	}

}
