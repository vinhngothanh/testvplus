	@extends('index')
	@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">	
				<form action="">
					<div class="form-group">
						<label >Thời gian:</label>
						<input name="dates" class="form-control" value="{{$dates}}">
						<input type="hidden" name="page" class="form-control" value="{{$page}}">
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				Tổng giao dịch: {{$count}} <br>
				Tổng giao dịch đã lọc: {{$countFilter}} <br>
				Tổng tiền {{ number_format($totalMoney)}}
			</div>
		</div>
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
		<div class="row">
			<div class="col-md-12">
			{{ $item->onEachSide(1)->links() }}
				
			</div>
		</div>
	</div>
	<script>
			$('input[name="dates"]').daterangepicker();
	</script>
	@endsection

