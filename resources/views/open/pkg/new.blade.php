@extends('admin::layout')

@section('title', '开放接口')

@section('content')
<ol class="breadcrumb">
  <li><a href="{{ url('open/') }}">开放接口</a></li>
  <li><a href="{{ url('open/pkg') }}">管理接口包</a></li>
  <li class="active">新建接口包</li>
</ol>

<div class="col-md-8">
<div class="panel panel-default">
	<div class="panel-body">

<form method="POST">
  <div class="form-group">
    <label >代码</label>
    <input type="text" name="code" class="form-control">
  </div>
  <div class="form-group">
    <label >名称</label>
    <input type="text" name="name" class="form-control">
  </div>
  <div class="form-group">
    <label >简介</label>
    <input type="text" name="subject" class="form-control">
  </div>
  <div class="form-group">
    <label >文档</label>
    <textarea class="form-control" name="doc" rows="20"></textarea>
  </div>
  <button type="submit" class="btn btn-default">保存</button>
</form>		

	</div>
</div>
</div>
@endsection