@extends('layouts.layout')

@section('main_content')
	@if ($errors->has('fail'))
  <h4 style="color:red;">{{ $errors->first('fail') }}</h4> 
  @endif
	<div class="row">
		<div class="col-md-6">
			<form class="form-inline" action="/class/big/create" method="post">
			  {{ csrf_field() }}
			  <div class="form-group">
			    <label for="exampleInputName2">主類別名稱</label>
			    <input type="text" class="form-control" name="name" placeholder="ex: 北部" required>
			  </div>
			  <button type="submit" class="btn btn-primary">新增主類別</button>
			</form>
		</div>
		<div class="col-md-6">
			<form class="form-inline" action="/class/small/create" method="post">
			  {{ csrf_field() }}
			  <div class="form-group">
			    <label for="exampleInputName2">次類別名稱</label>
			    <select class="form-control" name="id" required>
			    	@foreach ($class_list as $class)
			    	<option value="{{ $class->id }}">{{ $class->name }}</option>
			    	@endforeach
			    </select>
			    <input type="text" class="form-control" name="name" placeholder="ex: 台北市" required>
			  </div>
			  <button type="submit" class="btn btn-primary">新增次類別</button>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<table class="table table-striped" style="margin-top: 30px;">
			 	<thead>
			 		<th>主類別名稱</th>
			 		<th></th>
			 	</thead>
			 	@foreach ($class_list as $class)
	      <tr data-id="{{ $class->id }}" class="big_class" style="cursor: pointer;">
	        <td>{{ $class->name }}</td>
	        <td style="text-align: right;">
							<button type="submit" class="btn btn-danger big_class_delete" data-id="{{ $class->id }}">刪除類別</button>
	        </td>
	    	<tr>
	    	@endforeach
			</table>
		</div>
		<div class="col-md-6">
			@foreach ($class_small_list as $key => $class_small)
				<table class="table table-striped sub-class" id="sub{{ $key }}" style="margin-top: 30px; display: none;">
				 	<thead>
				 		<th>次類別名稱</th>
				 		<th></th>
				 	</thead>
				 	@foreach ($class_small as $class_small_detail)
		      <tr data-id="{{ $class_small_detail->id }}">
		        <td>{{ $class_small_detail->name }}</td>
		        <td style="text-align: right;">
								<button class="btn btn-danger sub_class_delete" data-id="{{ $class_small_detail->id }}">刪除類別</button>
		        </td>
		    	<tr>
		    	@endforeach
				</table>
			@endforeach
		</div>
	</div>
@stop

@section('script')
<script type="text/javascript">
	$(".big_class").on('click', function(){
		var id = $(this).data('id');
		$('.sub-class').hide();
		$('#sub' + id).show();
	});

	$(".sub_class_delete").on('click', function(){
		var small_id = $(this).data('id');
		if (confirm("確定刪除該次類別嗎?(連同底下 商家 一起刪除)"))
		{
		  $.ajax({
		  	url: '/class/small/delete',
		  	type: 'post',
		  	data: {
		  		id: small_id
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

	$(".big_class_delete").on('click', function(){
		var big_id = $(this).data('id');
		if (confirm("確定刪除該主類別嗎?(連同底下 次類別&商家 一起刪除)"))
		{
		  $.ajax({
		  	url: '/class/big/delete',
		  	type: 'post',
		  	data: {
		  		id: big_id
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
	
</script>
@stop