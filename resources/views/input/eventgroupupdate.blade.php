@extends('adminui::layout')

@section('title', '修改标签组')

@section('content')

<ol class="breadcrumb">
  <li><a href="{{ url('/input/event')}}">事件列表</a></li>
  <li class="active">修改 事件组</li>
</ol>

<div class="col-md-5">
<div class="panel panel-default">
	<div class="panel-heading">
	修改事件组名称
	</div>
	<div class="panel-body">

<form action="{{url('/input/event/groupupdate')}}" method="POST" >
  
   <div class="form-group">
    <label for="group_id">事件组ID</label>
    <input type="text" name="id" class="form-control" id="group_id" readonly="readonly" value="{{$return['id']}}">
  </div>

  <div class="form-group">
    <label for="group_name">事件组名称</label>
    <input type="text" name="name" class="form-control" id="group_name" value="{{$return['name']}}">
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
