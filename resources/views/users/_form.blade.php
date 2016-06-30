<div class="form-group">
	{!! sprintf(Form::label('first_name', '%s', ['class' => 'col-sm-4 control-label']), trans('phrases.first_name') . ' <span class="text-danger">*</span>') !!}
	<div class="col-md-6">
		{!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => trans('phrases.first_name')]) !!}
		{!! $errors->first('first_name', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<div class="form-group">
	{!! sprintf(Form::label('last_name', '%s', ['class' => 'col-sm-4 control-label']), trans('phrases.last_name') . ' <span class="text-danger">*</span>') !!}
	<div class="col-md-6">
	{!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => trans('phrases.last_name')]) !!}
		{!! $errors->first('last_name', '<span class="text-danger">:message</span>') !!}
	</div>
</div>

<div class="form-group">
	{!! sprintf(Form::label('email', '%s', ['class' => 'col-sm-4 control-label']), trans('phrases.email') . ' <span class="text-danger">*</span>') !!}
	<div class="col-md-6">
		{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('phrases.email')]) !!}
		{!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
	</div>
</div>

<div class="form-group">
	{!! sprintf(Form::label('phone', '%s', ['class' => 'col-sm-4 control-label']), trans('phrases.phone') . ' <span class="text-danger">*</span>') !!}
	<div class="col-md-6">
		{!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => trans('phrases.phone')]) !!}
		{!! $errors->first('phone', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('country', trans('phrases.country'), ['class' => 'col-sm-4 control-label']) !!}
	<div class="col-md-6">
		{!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => trans('phrases.country')]) !!}
		{!! $errors->first('country', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
@if (isset($user))
	<div class="form-group">
		<label class="col-md-4 control-label">{{ trans('phrases.current_image') }}</label>
		<div class="col-md-6" class="form-control">
			<img src="{{ Request::root() }}/uploads/images/thumbs/{{ $user->image}}.jpg" height="120" width="120" align="middle" style="align:center;">
		</div>
	</div>
@endif
<div class="form-group">
	{!! Form::label('image', trans('phrases.image'), ['class' => 'col-sm-4 control-label']) !!}
	<div class="col-md-6">
		{!! Form::file('image', ['class' => 'form-control']) !!}
		{!! $errors->first('image', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('password', trans('phrases.password'), ['class' => 'col-sm-4 control-label']) !!}
	<div class="col-md-6">
		{!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('phrases.password')]) !!}
		{!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('password_confirmation', trans('phrases.password_confirmation'), ['class' => 'col-sm-4 control-label']) !!}
	<div class="col-md-6">
		{!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('phrases.password_confirmation')]) !!}
		{!! $errors->first('password_confirmation', '<span class="text-danger">:message</span>') !!}
	</div>
</div>

<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		{!! Form::submit($submit_button_text, ['class' => 'btn btn-primary']) !!}
	</div>
</div>