@extends('app')

@section('title')
{{ trans('phrases.view_category') }}
@endsection


@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('phrases.category_list') }}</div>
				<div class="panel-body">
					<a href="category/create">{{ trans('phrases.add_new_category') }}</a>
					<table class="table" id="category-table">
						<thead>
							<tr>
								<th>{{ trans('phrases.name') }}</th>
								<th>{{ trans('phrases.type') }}</th>
								<th>{{ trans('phrases.edit') }}</th>
								<th>{{ trans('phrases.delete') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($categories as $category)
								<tr>
									<td>{{ $category->category_name }}</td>
									<td>{{ $category->type }}</td>
									<td><a class="btn btn-primary" href="category/{{ $category->id }}/edit"><span class="glyphicon glyphicon-edit large" aria-hidden="true"> {{ trans('phrases.edit') }}</span></a></td>
									<td>
										{!! Form::open(['method'=>'delete','route'=> ['accounting.category.destroy',$category->id ]]) !!}
		                                 <button onclick="return confirm('Do you really want to delete the Category ?');" class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> {{ trans('phrases.delete') }}</button>
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