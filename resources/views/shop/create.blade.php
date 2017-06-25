@extends('layouts.layout')

@section('main_content')
<div id="page-content-wrapper">
	<div class="container-fluid">
		<div class="right-bar">
			<h3>商家建立表單</h3>
			<form>
				<div class="form-group">
			    <div class="input-group col-md-5">
			      <div class="input-group-addon">大類別</div>
			      <input name="name" type="text" class="form-control" placeholder="ex: 哈哈燒臘" required>
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