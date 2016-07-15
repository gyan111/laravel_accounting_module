<?php namespace App\Http\Controllers;

use App\Project;
use App\User;
use Auth;
use Validator;
use Request;
use Redirect;
use Response;

use Image;
use Module\Accounting\Http\Requests\UserRequest;

class UserController extends Controller {

	public function __construct()
    {
    	$this->middleware('auth');
    	$this->middleware('super_admin', ['except' => ['edit', 'update']]);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::where('is_owner', 0)->get();

		return View('users.view')->withUsers($users);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  UserRequest $request
	 * @return Response
	 */
	public function store(UserRequest $request)
	{
		$user = User::create($request->all());

		$user->is_owner = count(User::all()) == 0 ? 1 : 0;
		$user->password = bcrypt($request->password);
		$user->save();

		if ($request->file('image'))
		{
		    $file = $request->file('image');

			$img_dir = "uploads/images";
   		    $img_thumb_dir = $img_dir . "/thumbs";

   		    // // Create folders if they don't exist
	        if (!file_exists($img_dir)) {
	            mkdir($img_dir, 0777, true);
	            mkdir($img_thumb_dir, 0777, true);
	        }

			$filename = $request->first_name . time();

			//$filename = $file->getClientOriginalName();
			//$extension =$file->getClientOriginalExtension(); 
			$upload_success = $file->move($img_dir, $filename);
			$img = Image::make('uploads/images/'. $filename);

			// resize the instance
			$img->resize(240, 240);

			// save the image as a new file
			$img->save($img_thumb_dir."/" . $filename . '.jpg');
		}
		
		$user->image = isset($filename) ? $filename : '';
		$user->save();

		$request->session()->flash('message', trans('message.user_created'));

		return Redirect::to('accounting.user');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id = false)
	{
		if($id) {
			return View('users.edit')->withUser(User::findOrFail($id));
		} else {
			return View('users.edit')->withUser(Auth::user());
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  UserRequest $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UserRequest $request, $id = false)
	{
		if ($id) {
			$user = User::findOrFail($id);
		} else {
			$user = Auth::user();
		}

		$user->update($request->all());
		$request->password != "" ? $user->password = bcrypt($request->password): "";
		$user->save();

		if ($request->file('image'))
		{
		    $file = $request->file('image');

			$img_dir = "uploads/images";
   		    $img_thumb_dir = $img_dir . "/thumbs";

   		    // // Create folders if they don't exist
	        if (!file_exists($img_dir)) {
	            mkdir($img_dir, 0777, true);
	            mkdir($img_thumb_dir, 0777, true);
	        }

			$filename = $request->first_name . time();

			//$filename = $file->getClientOriginalName();
			//$extension =$file->getClientOriginalExtension(); 
			$upload_success = $file->move($img_dir, $filename);
			$img = Image::make('uploads/images/'. $filename);

			// resize the instance
			$img->resize(240, 240);

			// save the image as a new file
			$img->save($img_thumb_dir."/" . $filename . '.jpg');
		}

		$user->image = isset($filename) ? $filename : '';
		$user->save();

		$request->session()->flash('message', trans('message.user_created'));

		if ($id) {
			return Redirect::to('accounting.user');
		} else {
			return Redirect::to('/');
		}
	}

	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Request $request
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request, $id)
	{
		if (Auth::user()->isSuperAdmin()) {
			$user = User::find($id);
			$user->delete();

			session()->flash('message', trans('message.user_deleted'));

			return Redirect::to('accounting.user');
		} else {
			if ($request->ajax()) {
                return response('Unauthorized.', 401);
			} else {
				$request->session()->flash('error', trans('errors.unauthorized'));
				return Redirect::to('/');
			}
		}
	}
}	