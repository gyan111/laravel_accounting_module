<div class="form-group">
{!! sprintf(Form::label('account_name', '%s', ['class' => 'col-sm-4 control-label']), trans('phrases.account_name') . ' <span class="text-danger">*</span>') !!}
	<div class="col-md-6">
		{!! Form::text('account_name', null, ['class' => 'form-control', 'placeholder' => trans('phrases.account_name')]) !!}
		{!! $errors->first('account_name', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		{!! Form::submit($submit_button_text, ['class' => 'btn btn-primary']) !!}
	</div>
</div>