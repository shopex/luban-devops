@extends('adminui::layout')

@section('title', '新建事件')

@section('content')

<ol class="breadcrumb">
  <li><a href="{{ url('/input/event')}}">事件列表</a></li>
  <li class="active">新建 事件</li>
</ol>

<div class="col-md-5">
<div class="panel panel-default">
	<div class="panel-heading">
	新建 事件
	</div>
	<div class="panel-body">

<form action="{{url('/input/event/new')}}" method="POST" >
<div class="form-group">
    <label for="groupid">事件组ID</label>
    <input type="text" name="gid" class="form-control" id="groupid" value = "{{$return['gid']}}"readonly="readonly">
    事件组名称：{{$return['name']}}
  </div>

  <div class="form-group">
    <label for="eventcode">事件码</label>
    <input type="text" name="code" class="form-control" id="eventcode">
  </div>

  <div class="form-group">
    <label for="eventname">事件名称</label>
    <input type="text" name="name" class="form-control" id="eventname">
  </div>

  <div class="form-group">
    <label for="eventdescs">事件描述</label>
    <input type="text" name="descs" class="form-control" id="eventdescs">
  </div>
 
  <div class="checkbox">
    <label>
      <input type="checkbox" name="enabled"> Check me out
    </label>
  </div>
  <button  type="submit" class="btn btn-default">Submit</button>
</form>		

	</div>
  </div>
</div>
@endsection