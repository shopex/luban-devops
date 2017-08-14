@extends('adminui::layout')

@section('title', '开放接口')

@section('content')
<style>
.api-top-title{background: #000;color:#fff;}
.api-sub-title{background: #f0f0f0;color:#000;}
</style>

<h3>开放接口</h3>
	<a class="btn btn-default" href="open/api/new">添加新接口</a>
	<a class="btn btn-default" href="{{ url('/open/pkg/') }}">管理接口包</a>
	<a class="btn btn-default" href="/open/key/">管理Key</a>

<hr />

<table class="table">
<thead>
	<tr class="api-top-title">
		<td width="20%">API Code</td>
		<td>名称</td>
		<td width="150px">已启用</td>
		<td width="150px">API类型</td>
		<td width="35%">后端地址</td>
	</tr>
</thead>
<tbody>
@foreach ($pkgs as $pkg)
	<tr class="api-sub-title">
		<td colspan="2">{{$pkg->code}} {{$pkg->name}}</td>
		<td colspan="3">
		@if($pkg->enabled)
		true
		@else
		false
		@endif
		</td>
	</tr>
	@foreach ($pkg->apis as $api)
	<tr>
		<td style="padding-left:40px"><a href="{{ url('/open/api/show') }}/{{$api->id}}">{{$pkg->code}}.{{$api->code}}</a></td>
		<td>{{$api->title}}</td>
		<td>
		@if($api->enabled)
		true
		@else
		false
		@endif
		</td>
		<td>hprose</td>
		<td>{{$api->backend}}:{{$api->backendMethod}}</td>
	</tr>
	@endforeach
@endforeach	
</tbody>
</table>
@endsection