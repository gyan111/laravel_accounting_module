@extends('app')

@section('title')
{{ trans('phrases.view_account') }}
@endsection


@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('phrases.account_list') }}</div>
				<div class="panel-body">
					<a href="account/create">{{ trans('phrases.add_new_account') }}</a>
					<table class="table" id="account-table">
						<thead>
							<tr>
								<th>{{ trans('phrases.name') }}</th>
								<th>{{ trans('phrases.edit') }}</th>
								<th>{{ trans('phrases.delete') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($accounts as $account)
							<tr>
								<td>{{ $account->account_name }}</td>
								<td><a class="btn btn-primary" href="account/{{ $account->id }}/edit"><span class="glyphicon glyphicon-edit large" aria-hidden="true"> {{ trans('buttons.edit') }}</span></a></td>
								<td>
									{!! Form::open(['method'=>'delete','route'=> ['account.destroy',$account->id ]]) !!}
	                                 <button onclick="return confirm('Do you really want to delete the Account ?');" class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> {{ trans('buttons.delete') }}</button>
	                                {!! Form::close() !!}   
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
