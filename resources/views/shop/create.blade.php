@extends('layouts.layout')
@section('style')
<style type="text/css">
	input[type=file]{
		display: none;
	}
	img{
		cursor: pointer;
	}
</style>
@stop
@section('main_content')
<div id="page-content-wrapper">
	<div class="container-fluid">
		<div class="right-bar">
			@if(isset($shop))
			<h3>商家更改表單</h3>
			@else
			<h3>商家建立表單</h3>
			@endif
			@if(isset($shop))
			<form action="/shop/update/{{ $shop->id }}" method="post" enctype="multipart/form-data">
			@else
			<form action="{{route('shop.create')}}" method="post" enctype="multipart/form-data">
			@endif
				{{ csrf_field() }}
				<div class="form-group">
			    <div class="input-group col-md-5">
			      <div class="input-group-addon">主類別</div>
			      <select class="form-control" id="big_class" name="shop_class_big_id" required>
			      	<option disabled selected value >請選擇</option>
		        	@foreach ($big_class_list as $big_class)
		        	<option value="{{ $big_class->id }}"<?php if (isset($shop) && $big_class->id == $shop->shop_class_big_id){ ?>selected<?php } ?>>{{ $big_class->name }}</option>
							@endforeach       	
		        </select>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="input-group col-md-5">
			      <div class="input-group-addon">次類別</div>
			      <select class="form-control" id="small_class" name="shop_class_id" required>
		        	<option disabled selected value >請選擇</option>
		        	@foreach ($class_list as $class)
		        	<option value="{{ $class->id }}" class="sub-class big-class-{{ $class->ShopClassBigid }}" <?php if (isset($shop) && $class->id == $shop->shop_class_id){ ?>selected<?php } ?> style="display: none;">{{ $class->name }}</option>
							@endforeach       	
		        </select>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="input-group col-md-5">
			      <div class="input-group-addon">商家名稱</div>
			      @if(isset($shop))
						<input name="name" type="text" class="form-control" placeholder="ex: Stevia 網路工作室 (限20字)" value="{{ $shop-> name }}" maxlength="20" required>
						@else
						<input name="name" type="text" class="form-control" placeholder="ex: Stevia 網路工作室 (限20字)" maxlength="20" required>
						@endif
			      
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="input-group col-md-5">
			      <div class="input-group-addon">商家圖片(清單顯示)</div>
			      @if(isset($shop) && !is_null($shop->photo))
			      <input type='file' name="photo" class="upl" id="photo" data-id="photo-preview" value="{{ $shop->photo }}">
			      <img id="photo-preview" src="/uploads/images/{{ $shop->photo }}" data-id="photo" style="width:100%;">
			      @else
			      <input type='file' name="photo" class="upl" id="photo" data-id="photo-preview">
			      <img id="photo-preview" src="/img/fakeimg.jpg" data-id="photo" style="width:100%;">
			    	@endif
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="input-group col-md-12">
			      <div class="input-group-addon">商家輪播(詳細顯示)</div>
			      @if(isset($shop) && !is_null($shop->cover_photo))
			      @foreach(json_decode($shop->cover_photo) as $i => $cover_photo)
			      <input type='file' name="cover_photo[]" class="upl" id="cover{{ $i }}" data-id="cover_preview{{ $i }}" value="{{ $cover_photo }}">
			      <img id="cover_preview{{ $i }}" src="/uploads/images/{{ $cover_photo }}" style="width:25%;" data-id="cover{{ $i }}">
			      @endforeach
			      @for($i = $i+1;$i <= 7; $i++)
			      <input type='file' name="cover_photo[]" class="upl" id="cover{{ $i }}" data-id="cover_preview{{ $i }}">
			      <img id="cover_preview{{ $i }}" src="/img/fakeimg.jpg" style="width:25%;" data-id="cover{{ $i }}">
			      @endfor
			      @else
			      @for($i = 0;$i <= 7; $i++)
			      <input type='file' name="cover_photo[]" class="upl" id="cover{{ $i }}" data-id="cover_preview{{ $i }}">
			      <img id="cover_preview{{ $i }}" src="/img/fakeimg.jpg" style="width:25%;" data-id="cover{{ $i }}">
			      @endfor
			      @endif
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="input-group col-md-5">
			      <div class="input-group-addon">商家電話</div>
			      @if(isset($shop))
			      <input name="phone" type="text" class="form-control" placeholder="ex: 0912345678" value="{{ $shop->phone }}"required>
			      @else
			      <input name="phone" type="text" class="form-control" placeholder="ex: 0912345678" required>
			      @endif
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="input-group">
			      <div class="input-group-addon">商家描述 (優惠清單畫面顯示)</div>
			      @if(isset($shop))
			      <input name="description" type="text" class="form-control" placeholder="ex: 哈哈燒臘" value="{{ $shop->description }}" required>
			      @else
			      <input name="description" type="text" class="form-control" placeholder="ex: 哈哈燒臘" required>
			      @endif
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="input-group">
			      <div class="input-group-addon">優惠價格</div>
			      @if(isset($shop))
			      <input name="price" type="text" class="form-control" placeholder="ex: 100" value="{{ $shop->price }}" required>
			      @else
			      <input name="price" type="text" class="form-control" placeholder="ex: 100" required>
			      @endif 
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="input-group">
			      <div class="input-group-addon">商家位置</div>
			      @if(isset($shop))
			      <input name="location" type="text" class="form-control" placeholder="ex: 台北市仁愛路三段6號" required id="location" value="{{ $shop->location }}">
			      <input type="hidden" name="lat" id="lat" value="{{ $shop->lat }}">
			      <input type="hidden" name="lng" id="lng" value="{{ $shop->lng }}">
			      @else
			      <input name="location" type="text" class="form-control" placeholder="ex: 台北市仁愛路三段6號" required id="location">
			      <input type="hidden" name="lat" id="lat">
			      <input type="hidden" name="lng" id="lng">
			      @endif
			    </div>
			  </div>
			   <div class="form-group">
			    <div class="input-group">
			      <div class="input-group-addon">商家優惠細項 (商家優惠畫面顯示)</div>
			      @if(isset($shop))
			      <textarea name="content" id="bodyField" placeholder="ex: 1.所有套餐優惠100元
      2.出示此app才可享有此優惠" class="form-control" required>{{ $shop->content }}</textarea>
     				@ckeditor('bodyField', ['filebrowserImageUploadUrl' => '/image/upload'])
			      @else
			      <textarea name="content" id="bodyField" placeholder="ex: 1.所有套餐優惠100元
      2.出示此app才可享有此優惠" class="form-control" required></textarea>
      			@ckeditor('bodyField', ['filebrowserImageUploadUrl' => '/image/upload'])
			      @endif
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="input-group">
			      <div class="input-group-addon">備註</div>
			      @if(isset($shop))
			      <input name="remark" type="text" class="form-control" placeholder="ex: 台北市仁愛路三段6號" value="{{ $shop->remark }}" required>
			      @else
			      <input name="remark" type="text" class="form-control" placeholder="ex: 台北市仁愛路三段6號" required>
			      @endif
			    </div>
			  </div>
			  <button type="submit" class="btn btn-primary">送出</button>
			</form>
		</div>
	</div>
</div>
@stop

@section('script')
<script src="https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyDaiFVrFBuxiar2jaPOJwYNSmFM9FKTyj8"></script>
<script type="text/javascript">
	$('#big_class').on('change', function(){
		var big_id = $(this).val();
		$('.sub-class').hide();
		$('.big-class-'+big_id).show();
		$('#small_class').prop('selectedIndex', 0);
	});

	$(function (){

 
    function preview(input, id) {
 
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#'+id).attr('src', e.target.result);
            }
 
            reader.readAsDataURL(input.files[0]);
        }
    }
 
    $("img").on("click", function (){
        var id = $(this).data('id');
        $("#"+id).trigger("click");
    });

    $("body").on("change", ".upl", function (){
		   var id = $(this).data('id');
		   preview(this, id);
		})

		$("body").on("change", "#location", function(){
			var geocoder = new google.maps.Geocoder();
			var address = $(this).val();

		   if (geocoder) {
		      geocoder.geocode({ 'address': address }, function (results, status) {
		         if (status == google.maps.GeocoderStatus.OK) {
		            $("#location").val(results[0].formatted_address);
		            $("#lat").val(results[0].geometry.location.lat());
		            $("#lng").val(results[0].geometry.location.lng());
		         }
		         else {
		            console.log("Geocoding failed: " + status);
		         }
		      });
		   }    
		});
	});

</script>


<script type="text/javascript">     
   
   
</script>
@stop