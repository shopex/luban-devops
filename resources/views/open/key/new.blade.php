@extends('admin::layout')

@section('title', '开放接口')

@section('content')
<ol class="breadcrumb">
  <li><a href="{{ url('open/') }}">开放接口</a></li>
  <li class="active">新建Key</li>
</ol>

<div class="col-md-5">
<div class="panel panel-default">
	<div class="panel-heading">
	基本Key信息
	</div>
	<div class="panel-body">

<form method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">备注说明</label>
    <input type="text" name="notes" class="form-control" id="exampleInputtext1">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">附加数据</label>
    <input type="text" name="data" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">有效期</label>
    <input type="text" name="expired" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="enabled"> Check me out
    </label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>		

	</div>
</div>
</div>
@endsection