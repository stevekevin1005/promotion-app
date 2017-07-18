@extends('layouts.layout')

@section('main_content')
@if ($errors->has('msg'))
  <h4 style="color:red;">{{ $errors->first('msg') }}</h4> 
  @endif
	<section class="form-horizontal row" style="">
		<div class="col-md-6 col-md-offset-3">
			<form action="{{ Route('member.edit') }}" method="post">
				{{ csrf_field() }}
				<div class="form-group">
			    <div class="input-group">
			      <div class="input-group-addon">請輸入新密碼</div>
			      <input name="password1" type="password" class="form-control" minlength="5" required>
			    </div>
			    <div class="input-group">
			      <div class="input-group-addon">二次輸入密碼</div>
			      <input name="password2" type="password" class="form-control" minlength="5" required>
			    </div>
				<button type="submit" class="btn btn-primary">送出</button>
			</form>
		</div>
	</section>
@stop