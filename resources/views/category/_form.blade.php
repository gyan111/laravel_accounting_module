<div class="form-group">
{!! sprintf(Form::label('category_name', '%s', ['class' => 'col-sm-4 control-label']), trans('phrases.category_name') . ' <span class="text-danger">*</span>') !!}
	<div class="col-md-6">
		{!! Form::text('category_name', null, ['class' => 'form-control', 'placeholder' => trans('phrases.category_name')]) !!}
		{!! $errors->first('category_name', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<div class="form-group">
{!! sprintf(Form::label('category_type', '%s', ['class' => 'col-sm-4 control-label']), trans('phrases.category_type') . ' <span class="text-danger">*</span>') !!}
	<div class="col-md-6">
	{!! Form::select('type', array('' => trans('phrases.select_type'), 'Income' => trans('phrases.income'), 'Expense' => trans('phrases.expense')), null , array('class' => 'form-control')) !!}
		{!! $errors->first('type', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		{!! Form::submit($submit_button_text, ['class' => 'btn btn-primary']) !!}
	</div>
</div>
