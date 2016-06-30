<div class="form-group">
	{!! sprintf(Form::label('account', '%s', ['class' => 'col-sm-4 control-label']), trans('phrases.account') . ' <span class="text-danger">*</span>') !!}
	<div class="col-md-6">
		{!! Form::select('account_id', ['' => trans('phrases.select_account')] + $accounts, null, array('class' => 'form-control')) !!}
		{!! $errors->first('account_id', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<div class="form-group">
	{!! sprintf(Form::label('amount', '%s', ['class' => 'col-sm-4 control-label']), trans('phrases.amount') . ' <span class="text-danger">*</span>') !!}
	<div class="col-md-6">
		{!! Form::text('amount', null, ['class' => 'form-control', 'placeholder' => trans('phrases.amount')]) !!}
		{!! $errors->first('amount', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<div class="form-group">
	{!! sprintf(Form::label('type', '%s', ['class' => 'col-sm-4 control-label']), trans('phrases.type') . ' <span class="text-danger">*</span>') !!}
	<div class="col-md-6">
	{!! Form::select('type', array('' => trans('phrases.select_type'), 'Income' => trans('phrases.income'), 'Expense' => trans('phrases.expense')), null , ['class' => 'form-control', 'id' => 'type_input']) !!}
		{!! $errors->first('type', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<div class="form-group">
{!! sprintf(Form::label('category_id', '%s', ['class' => 'col-sm-4 control-label']), trans('phrases.category') . ' <span class="text-danger">*</span>') !!}
	<div class="col-md-6">
		@if (isset($transaction))
			{!! Form::select('category_id', ['' => trans('phrases.select_category')] + App\Category::where('type', $transaction->type)->get()->lists('category_name', 'id'), $transaction->category_id , ['class' => 'form-control', 'id' => "category_input"]) !!}
		@else
			{!! Form::select('category_id', ['' => trans('phrases.select_category')], null, ['class' => 'form-control', 'id' => 'category_input']) !!}
		@endif
		{!! $errors->first('category_id', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('description', trans('phrases.description'), ['class' => 'col-sm-4 control-label']) !!}
	<div class="col-md-6">
		{!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => trans('phrases.description')]) !!}
		{!! $errors->first('description', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<div class="form-group">
	{!! sprintf(Form::label('date', '%s', ['class' => 'col-sm-4 control-label']), trans('phrases.date') . ' <span class="text-danger">*</span>') !!}
	<div class="col-md-6">
		{!! Form::text('date', $submit_button_text == 'Update' ? Carbon\Carbon::parse($transaction->date)->format(\Config::get('app.date_format')) : date(\Config::get('app.date_format')) , ['class' => 'form-control datepicker', 'placeholder' => trans('phrases.DD-MM-YYYY')]) !!}
		{!! $errors->first('date', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		{!! Form::submit($submit_button_text, ['class' => 'btn btn-primary']) !!}
	</div>
</div>