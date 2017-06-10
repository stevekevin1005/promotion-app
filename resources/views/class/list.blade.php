@extends('layouts.layout')

@section('main_content')
	@if ($errors->has('fail'))
  <h4 style="color:red;">{{ $errors->first('fail') }}</h4> 
  @endif
	<div class="row">
		<form class="form-inline" action="/class/create" method="post">
		  {{ csrf_field() }}
		  <div class="form-group">
		    <label for="exampleInputName2">類別名稱</label>
		    <input type="text" class="form-control" name="name" placeholder="ex: 台北市" required>
		  </div>
		  <button type="submit" class="btn btn-primary">新增類別</button>
		</form>
	</div>
	<div class="row">
		<table class="table table-striped" style="margin-top: 30px;">
		 	<thead>
		 		<th>類別名稱</th>
		 		<th></th>
		 	</thead>
		 	@foreach ($class_list as $class)
      <tr>
        <td>{{ $class->name }}</td>
        <td style="text-align: right;">
        	<form class="form-inline" action="/class/delete" method="post">
			  		{{ csrf_field() }}
			  		<input type="hidden" name="id" value="{{ $class->id }}">
						<button type="submit" class="btn btn-danger" data-id="{{ $class->id }}">刪除類別</button>
					</form>
        </td>
    	<tr>
    	@endforeach
		</table>
		{{ $class_list->links() }}
	</div>
@stop