@extends('layouts.layout')

@section('main_content')
	@if ($errors->has('fail'))
  <h4 style="color:red;">{{ $errors->first('fail') }}</h4> 
  @endif
	<section class="form-horizontal row" style="">
		<div class="col-md-6 col-md-offset-3">
			<form action="{{ Route('shop.list') }}" method="get">
				
				<div class="form-group">

					<div class="input-group">
						<label class="input-group-addon">主類別</label>
						<select class="form-control big_class" name="big_class" value="{{ Input::get('big_class',Session::get('big_class')) }}">
		        	<option value="">請選擇</option>
		        	@foreach ($big_class_list as $big_class)
		        	<option value="{{ $big_class->id }}"  <?php 
		        	if ($big_class->id == Input::get('big_class')){ ?>selected<?php } ?> >{{ $big_class->name }}</option>
							@endforeach       	
		        </select>
						<label class="input-group-addon">次類別</label>
						<select class="form-control" name="class">
		        	<option value="">請選擇</option>
		        	@foreach ($class_list as $class)
		        	<option value="{{ $class->id }}" class="sub-class big-class-{{ $class->ShopClassBigid }}" <?php if ($class->id == Input::get('class')){ ?>selected<?php } ?> >{{ $class->name }}</option>
							@endforeach       	
		        </select>
					</div>
					<button type="submit" class="btn btn-primary">送出</button>
				</div>
			</form>
		</div>
	</section>
	<button class="btn btn-primary"><a href="/shop/create">建立優惠商家</a></button>
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

@section('script')
<script type="text/javascript">
	$('.big_class').on('change', function(){
		var big_id = $(this).val();
		$('.sub-class').hide();
		$('.big-class-'+big_id).show();
	});

</script>
@stop