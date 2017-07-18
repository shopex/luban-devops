@extends('layouts.app')

@section('title', '新建标签组')

@section('content')

<ol class="breadcrumb">
  <li><a href="{{ url('/input/event')}}">事件列表</a></li>
  <li class="active">新建 事件组</li>
</ol>

<div class="col-md-5">
<div class="panel panel-default">
	<div class="panel-heading">
	事件组名称
	</div>
	<div class="panel-body">

<form action="{{url('/input/event/groupnew')}}" method="POST" >
  <div class="form-group">
    <label for="eventgroupname">事件组名称</label>
    <input type="text" name="name" class="form-control" id="eventgroupname">
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