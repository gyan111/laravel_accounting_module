@extends('app')

@section('title')
{{ trans('phrases.manage_users') }}
@endsection


@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('phrases.user_list') }}</div>
				<div class="panel-body">
					<a href="user/create">{{ trans('phrases.create_a_user') }}</a>
					<table class="table" id="user-table">
						<thead>
							<tr>
								<th>{{ trans('phrases.name') }}</th>
								<th>{{ trans('phrases.email') }}</th>
								<th>{{ trans('phrases.phone') }}</th>
								<th>{{ trans('phrases.country') }}</th>
								<th>{{ trans('phrases.image') }}</th>
								<th>{{ trans('phrases.edit') }}</th>
								<th>{{ trans('phrases.delete') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $user)
							<tr>
								<td>{{ $user->first_name }} {{ $user->last_name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->phone }}</td>
								<td>{{ $user->country }}</td>
								<td><img src="uploads/images/thumbs/{{ $user->image }}.jpg" width="45px" height="45px"></td>
								<td><a class="btn btn-primary" href="user/{{ $user->id }}/edit"><span class="glyphicon glyphicon-edit large" aria-hidden="true"> {{ trans('buttons.edit') }}</span></a></td>
								<td>
									{!! Form::open(['method'=>'delete','route'=> ['user.destroy',$user->id ]]) !!}
	                                 <button onclick="return confirm('{{ trans('message.confirm_delete_user') }}');" class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> {{ trans('buttons.delete') }}</button>
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
