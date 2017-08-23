@extends('admin::layout')

@section('title', '开放接口')

@section('header')
<div class="finder-header">
	<div class="row api-top-title">
		<div class="col-md-2">API Code</div>
		<div class="col-md-2">名称</div>
		<div class="col-md-2">已启用</div>
		<div class="col-md-2">API类型</div>
		<div class="col-md-2">后端地址</div>
	</div>
</div>
@endsection

@section('action-bar')
	<a class="btn btn-default" href="open/api/new">添加新接口</a>
	<a class="btn btn-default" href="{{ url('/open/pkg/') }}">管理接口包</a>
	<a class="btn btn-default" href="/open/key/">管理Key</a>
@endsection

@section('content')
<div class="finder-body">
@foreach ($pkgs as $pkg)
	<div class="finder-group-title row">
		<div class="col-md-4">{{$pkg->code}} {{$pkg->name}}</div>
		<div class="col-md-8">
		@if($pkg->enabled)
		true
		@else
		false
		@endif
		</div>
	</div>
	@foreach ($pkg->apis as $api)
	<div class="row">
		<div class="col-md-2" style="padding-left:40px"><a href="{{ url('/open/api/show') }}/{{$api->id}}">{{$pkg->code}}.{{$api->code}}</a></div>
		<div class="col-md-2">{{$api->title}}</div>
		<div class="col-md-2">
		@if($api->enabled)
		true
		@else
		false
		@endif
		</div>
		<div class="col-md-2">hprose</div>
		<div class="col-md-2">{{$api->backend}}:{{$api->backendMethod}}</div>
	</div>
	@endforeach
@endforeach	
</div>
@endsection