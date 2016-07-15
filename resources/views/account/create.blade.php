@extends('app')

@section('title')
{{ trans('phrases.add_account') }}
@endsection


@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('phrases.add_account') }}</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>{{ trans('phrases.whoops') }}</strong> {{ trans('message.input_problem') }}<br><br>
						</div>
					@endif

					{!! Form::open(['route' => 'accounting.account.store', 'class' => 'form-horizontal']) !!}

						@include('account._form',['submit_button_text' => trans('buttons.create')])

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
