@extends('layouts.layout')

@section('main_content')
<div id="page-content-wrapper">
	<div class="container-fluid">
		<div class="right-bar">
			<h3>商家建立表單</h3>
			<form>
				{{ csrf_field() }}
				<div class="form-group">
			    <div class="input-group col-md-5">
			      <div class="input-group-addon">主類別</div>
			      <select class="form-control big_class">
			      	<option disabled selected value >請選擇</option>
		        	@foreach ($big_class_list as $big_class)
		        	<option value="{{ $big_class->id }}"  <?php 
		        	if ($big_class->id == Input::get('big_class')){ ?>selected<?php } ?> >{{ $big_class->name }}</option>
							@endforeach       	
		        </select>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="input-group col-md-5">
			      <div class="input-group-addon">次類別</div>
			      <select class="form-control" name="shop_class_id" required>
		        	<option disabled selected value >請選擇</option>
		        	@foreach ($class_list as $class)
		        	<option value="{{ $class->id }}" class="sub-class big-class-{{ $class->ShopClassBigid }}" <?php if ($class->id == Input::get('class')){ ?>selected<?php } ?> style="display: none;">{{ $class->name }}</option>
							@endforeach       	
		        </select>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="input-group col-md-5">
			      <div class="input-group-addon">商家名稱</div>
			      <input name="name" type="text" class="form-control" placeholder="ex: 哈哈燒臘" required>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="input-group col-md-5">
			      <div class="input-group-addon">商家電話</div>
			      <input name="phone" type="text" class="form-control" placeholder="ex: 0912345678" required>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="input-group">
			      <div class="input-group-addon">商家描述 (優惠清單畫面顯示)</div>
			      <input name="description" type="text" class="form-control" placeholder="ex: 哈哈燒臘" required>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="input-group">
			      <div class="input-group-addon">優惠價格</div>
			      <input name="price" type="text" class="form-control" placeholder="ex: 100" required>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="input-group">
			      <div class="input-group-addon">商家位置</div>
			      <input name="location" type="text" class="form-control" placeholder="ex: 台北市仁愛路三段6號" required>
			    </div>
			  </div>
			   <div class="form-group">
			    <div class="input-group">
			      <div class="input-group-addon">商家優惠細項 (商家優惠畫面顯示)</div>
			      <textarea name="content" placeholder="ex: 1.所有套餐優惠100元
      2.出示此app才可享有此優惠" class="form-control" required></textarea>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="input-group">
			      <div class="input-group-addon">備註</div>
			      <input name="remark" type="text" class="form-control" placeholder="ex: 台北市仁愛路三段6號" required>
			    </div>
			  </div>
			  <button type="submit" class="btn btn-primary">送出</button>
			</form>
		</div>
	</div>
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