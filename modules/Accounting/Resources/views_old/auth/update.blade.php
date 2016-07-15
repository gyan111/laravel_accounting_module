@extends('app')

@section('title')
Update Profile
@endsection


@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Update Profile</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<!-- <ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul> -->
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('profile') }}" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">First Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="firstname" value="{{ null !== Input::old('firstname') ? Input::old('firstname') : $user->firstname }}" placeholder="First Name">
								{!! $errors->first('firstname', '<span class="text-danger">:message</span>') !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Last Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="lastname" value="{{ null !== Input::old('lastname') ? Input::old('lastname') : $user->lastname }}" placeholder="Last Name">
								{!! $errors->first('lastname', '<span class="text-danger">:message</span>') !!}
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ null !== Input::old('email') ? Input::old('email') : $user->email }}" placeholder="Email">
								{!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Phone</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="phone" value="{{ null !== Input::old('phone') ? Input::old('phone') : $user->phone }}" placeholder="Phone Number">
								{!! $errors->first('phone', '<span class="text-danger">:message</span>') !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Country</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="country" value="{{ null !== Input::old('country') ? Input::old('country') : $user->country }}" placeholder="Country">
								{!! $errors->first('country', '<span class="text-danger">:message</span>') !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Current Image</label>
							<div class="col-md-6" class="form-control">
								<img src="{{ Request::root() }}/uploads/images/thumbs/{{ $user->image}}.jpg" height="120" width="120" align="middle" style="align:center;">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">image</label>
							<div class="col-md-6">
								<input class="form-control" name="image" type="file" >
								{!! $errors->first('image', '<span class="text-danger">:message</span>') !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
								{!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
								{!! $errors->first('password_confirmation', '<span class="text-danger">:message</span>') !!}
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Update Profile
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
