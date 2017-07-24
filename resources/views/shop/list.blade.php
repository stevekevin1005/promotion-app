@extends('layouts.layout')

@section('main_content')
	@if ($errors->has('msg'))
  <h4 style="color:red;">{{ $errors->first('msg') }}</h4> 
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
						<select class="form-control" name="class" id="small_class">
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
	<button class="btn btn-danger" id="multi_shop_delete">刪除選擇店家</button>
	<div class="row">
		<table class="table table-striped" style="margin-top: 30px;">
		 	<thead>
		 		<th></th>
		 		<th>主類別</th>
		 		<th>次類別</th>
		 		<th>商店名稱</th>
		 		<th></th>
		 	</thead>
		 	@foreach ($shop_list as $shop)
      <tr>
      	<td><input type="checkbox" value="{{ $shop->id}}" class="delete"></td>
      	<td>{{ $shop->big_class()->first()->name  }}</td>
      	<td>{{ $shop->small_class()->first()->name }}</td>
        <td>{{ $shop->name }}</td>
        <td style="text-align: right;">
        	<a href="/shop/update/{{ $shop->id }}"><button class="btn btn-primary" >更新店家</button></a>
					<button class="btn btn-danger shop_delete" data-id="{{ $shop->id }}">刪除店家</button>
        </td>
    	<tr>
    	@endforeach
		</table>
		{!! $shop_list->appends(['big_class' => Request::query('big_class'), 'class' => Request::query('class')])->links() !!}
	</div>
@stop

@section('script')
<script type="text/javascript">
	$('.big_class').on('change', function(){
		var big_id = $(this).val();
		$('.sub-class').hide();
		$('.big-class-'+big_id).show();
		$('#small_class').prop('selectedIndex', 0);
	});

	$(".shop_delete").on('click', function(){
		var shop_id = $(this).data('id');
		if (confirm("確定刪除該店家嗎?"))
		{
		  $.ajax({
		  	url: '/shop/delete',
		  	type: 'post',
		  	data: {
		  		id: [shop_id]
		  	},
		  	success: function(res){
		  		alert(res);
		  		location.reload();
		  	},
		  	error: function(res){
		  		alert(res);
		  		location.reload();
		  	}
		  });
		}
	});	

	$("#multi_shop_delete").on('click', function(){
		var delete_id_array = $('.delete:checked').map(function() { return $(this).val(); }).get();
		if (confirm("確定刪除這些店家嗎?"))
		{
		  $.ajax({
		  	url: '/shop/delete',
		  	type: 'post',
		  	data: {
		  		id: delete_id_array
		  	},
		  	success: function(res){
		  		alert(res);
		  		location.reload();
		  	},
		  	error: function(res){
		  		alert(res);
		  		location.reload();
		  	}
		  });
		}
	})
</script>
@stop