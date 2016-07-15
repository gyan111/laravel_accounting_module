<?php namespace Modules\Accounting\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
use Modules\Accounting\Entities\Transaction;
// use App\Transaction;
use Modules\Accounting\Entities\Category;
use Modules\Accounting\Entities\Account;
use Auth;
use Validator;
use Request;
use Redirect;
use Carbon\Carbon;
use Modules\Accounting\Http\Requests\TransactionRequest;

class TransactionController extends Controller {

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
		if (Request::ajax()) {
			return response()->json(Transaction::all());
		} else 	{
			// return view('page::admin.create');
			return View('transaction.view')->withTransactions(Transaction::all())->withCategories(Category::all()->lists('category_name', 'id'))->withAccounts(Account::all()->lists('account_name', 'id'));
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		return view('transaction.create')->withCategories(Category::all()->lists('category_name', 'id'))->withAccounts(Account::all()->lists('account_name', 'id'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  TransactionRequest $request
	 * @return Response
	 */
	public function store(TransactionRequest $request)
	{
		$transaction = Transaction::create($request->all());
		$category = Category::findOrFail($request->category_id);
		$account = Account::findOrFail($request->account_id);

		// $transaction->createdBy()->associate(Auth::user());
        // $transaction->modifiedBy()->associate(Auth::user());
        $transaction->account()->associate($account);
        $transaction->category()->associate($category);
        $transaction->save();

	    $transaction_id = $transaction->id;

		if (Request::ajax())
		{
			echo $transaction_id;
		}
		else
		{
			$request->session()->flash('message', trans('message.transaction_added'));

			return Redirect::to('accounting/transaction');
		}
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
		return view('transaction.edit')->withTransaction(Transaction::findOrFail($id))->withCategories(Category::all()->lists('category_name', 'id'))->withaccounts(Account::all()->lists('account_name', 'id'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  TransactionRequest $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(TransactionRequest $request, $id)
	{
		$transaction = Transaction::findOrFail($id);

		$transaction->update($request->all());
		$category = Category::findOrFail($request->category_id);
		$account = Account::findOrFail($request->account_id);

		// $transaction->createdBy()->associate(Auth::user());
        // $transaction->modifiedBy()->associate(Auth::user());
        $transaction->account()->associate($account);
        $transaction->category()->associate($category);
        $transaction->save();

        $request->session()->flash('message', trans('message.transaction_updated'));

		return Redirect::to('accounting/transaction');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$transaction = Transaction::findOrFail($id);
		$transaction->delete();

		session()->flash('message', trans('message.transaction_deleted'));

		return Redirect::to('transaction');
	}
}
