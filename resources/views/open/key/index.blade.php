@extends('admin::layout')

@section('title', '开放接口')

@section('content')
<div class="container">
<ol class="breadcrumb">
  <li><a href="{{ url('open/') }}">开放接口</a></li>
  <li class="active">管理Key</li>
</ol>

	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="{{ url('/open/key/new') }}">添加新Key</a>
		</div>
		<div class="panel-body">

		<table class="table">
		<thead>
			<tr>
				<td>Key</td><td>备注</td><td>过期时间</td>
			</tr>
		</thead>
		<tbody>
		@foreach ($keys as $key)
			<tr>
				<td><a href="{{ url('open/key/show') }}/{{ $key->apiKey }}">{{ $key->apiKey }}</a></td><td>{{ $key->notes }}</td><td>{{ $key->expired }}</td>
			</tr>
		@endforeach
		</tbody>
		</table>

	</div>
</div>
</div>
@endsection