@extends('app')

@section('title')
{{ trans('phrases.transactions') }}
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('phrases.transaction_list') }}</div>
				<div class="panel-body">
					<a href="transaction/create">{{ trans('phrases.add_new_transactions') }}</a>
					<table class="table" id="transaction-table">
						<thead>
							<tr>
								<th>{{ trans('phrases.date') }}</th>
								<th>{{ trans('phrases.info') }}</th>
								<th>{{ trans('phrases.type') }}</th>
								<th>{{ trans('phrases.category') }}</th>
								<th>{{ trans('phrases.amount') }}</th>
								<th>{{ trans('phrases.account') }}</th>
								<th>{{ trans('phrases.edit') }}</th>
								<th>{{ trans('phrases.delete') }}</th>
							</tr>
						</thead>
						<thead>
							<tr id="add_transaction_tr">
								<td>
									{!! Form::text('date', date(\Config::get('app.date_format')) , ['id' => 'date_input', 'class' => 'input-sm form-control datepicker', 'placeholder' => trans('phrases.DD-MM-YYYY'), 'size' => 10]) !!}
								</td>
								<td>
									{!! Form::text('description', null, ['size' => 10, 'id' => 'info_input', 'class' => 'input-sm form-control', 'placeholder' => trans('phrases.description')]) !!}
								</td>
								<td>
									{!! Form::select('type_input', ['' => trans('phrases.select_type'), 'Income' => trans('phrases.income'), 'Expense' => trans('phrases.expense')], '' , array('class' => 'input-sm form-control', 'id' => 'type_input')) !!}
								</td>
								<td style="width:100px">
									{!! Form::select('category_input', ['' => trans('phrases.select_category')]	, Input::old('category_id'), array('class' => 'input-sm form-control', 'id' => 'category_input')) !!}
								</td>
								<td>
									{!! Form::text('amount', null, ['size' => 10, 'class' => 'input-sm form-control', 'placeholder' => trans('phrases.amount'), 'id' => 'amount_input']) !!}									
								</td>
								<td>
									{!! Form::select('account_input', ['' => trans('phrases.select_account')] +  $accounts->toArray(), Input::old('account_id'), array('class' => 'input-sm form-control', 'id' => 'account_input')) !!}
								</td>
								<td>
									<button style="margin-left: 25px;" id="add_transaction_on_transaction_view" class="btn btn-info btn-sm">{{ trans('buttons.add') }}</button>
								</td>
								<td></td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							@foreach ($transactions as $transaction)
							<tr class="view_transaction_tr">
								<td style="width:100px">
									<span style="display:none;">{{ date("Ymd", strtotime($transaction->date)) }}</span>
									<span id="date_field_{{ $transaction->id }}">{{ date(\Config::get('app.date_format'), strtotime($transaction->date)) }}</span>
									<input style="display:none;" size='10' id="date_input_{{ $transaction->id }}" type="text" class="input-sm input-small form-control datepicker hidden_input" value="{{ date(\Config::get('app.date_format'), strtotime($transaction->date)) }}" name="date" placeholder="dd/mm/yyyy">
								</td>
								<td>
									<span id="info_field_{{ $transaction->id }}">{{ $transaction->description }}</span>
									<input style="display:none;" size='10' id="info_input_{{ $transaction->id }}" type="text" class="form-control hidden_input input-sm" value="{{ $transaction->description }}" name="payment_info" placeholder="Information">
								</td>
								<td>
								<span id="type_field_{{ $transaction->id }}" class="label 
								    @if ($transaction->type == 'Income')
									    label-success
									@else
									    label-danger
									@endif

									">{{ $transaction->type }}
									</span>
									{!! Form::select('type_input', ['' => trans('phrases.select_type'), 'Income' => trans('phrases.income'), 'Expense' => trans('phrases.expense')],  $transaction->type  , array('style' => 'display:none;', 'class' => 'input-sm form-control hidden_input', 'id' => "type_input_$transaction->id")) !!}
								</td>
								<td>
									<span id="category_field_{{ $transaction->id }}">
										{{ $categories[$transaction->category_id]}}
									</span>
									{!! Form::select('category_input', ['' => trans('phrases.select_category')] + Modules\Accounting\Entities\Category::where('type', $transaction->type)->get()->lists('category_name', 'id')->toArray(), $transaction->category_id , array('style' => 'display:none;', 'class' => 'input-sm form-control hidden_input', 'id' => "category_input_$transaction->id")) !!}
								</td>
								<td>
									<span id="amount_field_{{ $transaction->id }}" class=" 
								    @if ($transaction->type == 'Income')
									    text-success
									@else
									    text-danger
									@endif

									">{{ $transaction->amount }}

									</span>
									<input style="display:none"; size="10" id="amount_input_{{ $transaction->id }}" type="text" class="input-sm form-control hidden_input" value="{{ $transaction->amount }}" name="amount" placeholder="Amount">
								</td>
								<td>
									<span id="account_field_{{ $transaction->id }}">
										{{ $accounts[$transaction->account_id]}}
									</span>
									{!! Form::select('account_input', ['' => trans('phrases.select_account')] + $accounts->toArray(), $transaction->account_id, array('style' => 'display:none;', 'class' => 'input-sm form-control hidden_input', 'id' => "account_input_$transaction->id")) !!}
								</td>
								<td>
									<a id="update_{{ $transaction->id }}" class="btn btn-info btn-sm update_transaction_button">
										{{ trans('buttons.edit') }}
									</a>
									<!--a class="btn btn-primary" href="transaction/{{ $transaction->id }}/edit"><span class="glyphicon glyphicon-edit large" aria-hidden="true"> Edit</span></a-->
								</td>
								<td>
									<a id="cancel_button_{{ $transaction->id }}" style="display:none;" class="btn btn-info btn-sm cancel_button">{{ trans('buttons.cancel') }}</a>
								<a id="delete_transaction_{{ $transaction->id }}" class="btn btn-sm btn-danger delete_transaction_button">{{ trans('buttons.delete') }}</a>
								   <!--
									{!! Form::open(['method'=>'delete','route'=> ['accounting.transaction.destroy',$transaction->id ]]) !!}
	                                 <button onclick="return confirm('Do you really want to delete the Transaction ?');" class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</button>
	                                {!! Form::close() !!}   
	                                -->
	                            </td>
							</tr>
							@endforeach
						</tbody>
					</table>
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
