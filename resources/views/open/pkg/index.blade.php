@extends('adminui::layout')

@section('title', '开放接口')

@section('content')
<ol class="breadcrumb">
  <li><a href="{{ url('open/') }}">开放接口</a></li>
  <li class="active">管理接口包</li>
</ol>

	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="{{ url('/open/pkg/new') }}">添加新接口包</a>
		</div>
		<div class="panel-body">

		<table class="table">
		<thead>
			<tr>
				<td>接口包</td><td>名称</td><td>简介</td>
			</tr>
		</thead>
		<tbody>
		@foreach ($pkgs as $pkg)
			<tr>
				<td><a href="{{ url('open/pkg/show') }}/{{ $pkg->id }}">{{ $pkg->code }}</a></td><td>{{ $pkg->name }}</td><td>{{ $pkg->subject }}</td>
			</tr>
		@endforeach
		</tbody>
		</table>

	</div>
</div>

@endsection