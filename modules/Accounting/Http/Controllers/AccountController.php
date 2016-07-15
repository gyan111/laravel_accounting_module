<?php namespace Modules\Accounting\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
// use App\Transaction;
use Modules\Accounting\Entities\Account;
use Validator;
use Request;
use Redirect;
use Modules\Accounting\Http\Requests\AccountRequest;


class AccountController extends Controller {

	public function __construct()
    {
    	// $this->middleware('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View('account.view')->withAccounts(Account::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('account.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  AccountRequest $request
	 * @return Response
	 */
	public function store(AccountRequest $request)
	{
		$account = Account::create($request->all());

		// $account->createdBy()->associate(Auth::user());
        // $account->modifiedBy()->associate(Auth::user());
        $account->save();

		$request->session()->flash('message', trans('message.account_added'));

		return Redirect::to('accounting/account');	
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View('account.edit')->withAccount(Account::findOrFail($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  AccountRequest $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(AccountRequest $request, $id)
	{
		$account = Account::findOrFail($id);

		$account->update($request->all());
        // $account->modifiedBy()->associate(Auth::user());
        $account->save();

		$request->session()->flash('message', trans('message.account_updated'));

		return Redirect::to('accounting/account');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$account = Account::find($id);
		$account->delete();

		session()->flash('message', trans('message.account_deleted'));

		return Redirect::to('accounting/account');
	}

}
