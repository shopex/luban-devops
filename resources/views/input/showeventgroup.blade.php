@extends('layouts.app')

@section('title', '查看标签明细信息')

@section('content')
<ol class="breadcrumb">
   <li><a href="{{ url('/input/event') }}">管理事件组</a></li>
   <li><a href="">管理标签</a></li>
  <li class="active">查看标签</li>
</ol>

<div class="col-md-5">
<div class="panel panel-default">
	<div class="panel-heading">
	标签基本信息
	</div>
	<div class="panel-body">

    <dl class="dl-horizontal">
      <dt>事件组ID</dt>
      <dd>{{$return->id}}</dd>

      <dt>事件组名称</dt>
      <dd>{{$return->name}}</dd>

      <dt>建立时间</dt>
      <dd>{{$return->created}}</dd>

      <dt>更新名称</dt>
      <dd>{{$return->updated}}</dd>

      

    </dl>

	</div>
</div>
</div>
@endsection