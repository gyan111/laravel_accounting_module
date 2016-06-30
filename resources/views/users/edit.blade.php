@extends('app')

@section('title')
	@if ($user->id == Auth::user()->id)
		{{ trans('phrases.update_profile') }}
	@else
		{{ trans('phrases.update_user') }}
	@endif
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"> 
					@if ($user->id == Auth::user()->id)
						{{ trans('phrases.update_profile') }}
					@else
						{{ trans('phrases.update_user') }}
					@endif
				</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>{{ trans('phrases.whoops') }}</strong> {{ trans('message.input_problem') }}<br>
						</div>
					@endif

					{!! Form::model($user,['method' => 'PUT', 'route' => ['user.update', $user->id], 'class' => 'form-horizontal', 'files' => true]) !!}
						{!! Form::hidden('id', $user->id) !!}
						@include('users._form',['submit_button_text' => trans('buttons.update')])

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
