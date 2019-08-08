@extends('index')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			@if(count($item)<=0)
			<h3 style="margin-left:10px">Không có dữ liệu</h3>
			@else
			<table class="table table-hover">
				<tr>
					<th>id</th>
					<th>receiver</th>
					<th>msgdata</th>
					<th>keyword</th>
					<th>operator</th>
					<th>money</th>
					<th>loggingTime</th>
				</tr>
				@foreach($item as $detail)
				<tr>
					<td>{{$detail->id}}</td>
					<td>{{$detail->receiver}}</td>
					<td>{{$detail->msgdata}}</td>
					<td>{{$detail->keyword}}</td>
					<td>{{$detail->operator}}</td>
					<td>{{$detail->money}}</td>
					<td>{{$detail->loggingTime}}</td>
				</tr>
				@endforeach
			</table>
			@endif
		</div>
	</div>
</div>

@endsection