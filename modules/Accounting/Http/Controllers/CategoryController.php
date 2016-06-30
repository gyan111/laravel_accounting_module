<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Category;
use Validator;
use Request;
use Redirect;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller {

	public function __construct()
    {
    	$this->middleware('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View('category.view')->withCategories(Category::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('category.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  CategoryRequest $request
	 * @return Response
	 */
	public function store(CategoryRequest $request)
	{
		$category = Category::create($request->all());
		$category->createdBy()->associate(Auth::user());
        $category->modifiedBy()->associate(Auth::user());
        $category->save();

		$request->session()->flash('message', trans('message.category_added'));

		return Redirect::to('category');
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
		return View('category.edit')->withCategory(Category::findOrFail($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  CategoryRequest $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(CategoryRequest $request, $id)
	{
		$category = Category::find($id);

		$category->update($request->all());
        $category->modifiedBy()->associate(Auth::user());
        $category->save();

		$request->session()->flash('message', trans('message.category_updated'));

		return Redirect::to('category');	
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$category = Category::findOrFail($id);
		$category->delete();

		session()->flash('message', trans('message.categorty_deleted'));
		return Redirect::to('category');
	}

	/**
	 * Get categories according to the income or expense send un the parameter value
	 *
	 * @param  String  $type
	 * @return Response
	 */
	public function getCategories($type)
	{
		$category = Category::where('type', $type)->get()->lists('category_name', 'id');

		return $category;
	}

}
