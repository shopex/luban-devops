@extends('layouts.app')

@section('title', '修改事件')

@section('content')

<ol class="breadcrumb">
  <li><a href="{{ url('/input/event')}}">事件列表</a></li>
  <li class="active">修改 事件</li>
</ol>

<div class="col-md-5">
<div class="panel panel-default">
	<div class="panel-heading">
	修改事件名称
	</div>
	<div class="panel-body">

<form action="{{url('/input/event/update')}}" method="POST" >
   
   <div class="form-group">
    <label for="eventgid">事件组ID</label>
    <input type="text" name="gid" class="form-control" id="eventgid" readonly="readonly" value="{{$return->gid}}">
  </div>

   <div class="form-group">
    <label for="eventid">事件ID</label>
    <input type="text" name="id" class="form-control" id="eventid" readonly="readonly" value="{{$return->id}}">
  </div>

  <div class="form-group">
    <label for="eventname">事件名称</label>
    <input type="text" name="name" class="form-control" id="eventname" value="{{$return->name}}">
  </div>

  <div class="form-group">
    <label for="eventcode">事件码</label>
    <input type="text" name="code" class="form-control" id="eventcode" value="{{$return->code}}">
  </div>

  <div class="form-group">
    <label for="eventdescs">事件描述</label>
    <input type="text" name="descs" class="form-control" id="eventdescs" value="{{$return->descs}}">
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
