@extends('layouts.layout')

@section('main_content')
	@if ($errors->has('fail'))
  <h4 style="color:red;">{{ $errors->first('fail') }}</h4> 
  @endif
	<section class="form-horizontal row" style="">
		<div class="col-md-4 col-md-offset-4">
			<form action="{{ Route('shop.list') }}" method="get">
				<div class="form-group">
					<div class="input-group">
						<label class="input-group-addon">所屬類別</label>
						<select class="form-control" name="class" value="{{ Input::get('status',Session::get('status')) }}">
		        	<option value="">請選擇</option>
		        	@foreach ($class_list as $class)
		        	<option value="{{ $class->id }}">{{ $class->name }}</option>
							@endforeach       	
		        </select>
					</div>
				</div>
				<div class="row" style="text-align: right">
					<button type="submit" class="btn btn-primary">送出</button>
				</div>
			</form>
		</div>
	</section>
	<hr>
	<div class="row">
		<table class="table table-striped" style="margin-top: 30px;">
		 	<thead>
		 		<th>商店名稱</th>
		 		<th></th>
		 	</thead>
		 	@foreach ($shop_list as $shop)
      <tr>
        <td>{{ $shop->name }}</td>
        <td style="text-align: right;">
        	<form class="form-inline" action="/shop/delete" method="post">
			  		{{ csrf_field() }}
			  		<input type="hidden" name="id" value="{{ $shop->id }}">
						<button type="submit" class="btn btn-danger" data-id="{{ $shop->id }}">刪除店家</button>
					</form>
        </td>
    	<tr>
    	@endforeach
		</table>
	</div>
@stop