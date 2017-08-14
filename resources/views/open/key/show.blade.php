@extends('adminui::layout')

@section('title', '开放接口')

@section('content')
<ol class="breadcrumb">
  <li><a href="{{ url('open/') }}">开放接口</a></li>
  <li><a href="{{ url('open/key/') }}">管理Key</a></li>
  <li class="active">查看Key</li>
</ol>

<div class="col-md-5">
<div class="panel panel-default">
	<div class="panel-heading">
	基本信息
	</div>
	<div class="panel-body">

    <dl class="dl-horizontal">
      <dt>key</dt>
      <dd>{{ $key->apiKey }}</dd>

      <dt>secret</dt>
      <dd>{{ $key->secret }}</dd>

      <dt>备注</dt>
      <dd>{{ $key->notes }}</dd>

      <dt>附加数据</dt>
      <dd>{{ $key->data }}</dd>

      <dt>有效期</dt>
      <dd>{{ $key->expired }}</dd>

      <dt>创建时间</dt>
      <dd>{{ $key->created }}</dd>

      <dt>最后更改</dt>
      <dd>{{ $key->updated }}</dd>

      <dt>是否启用</dt>
      <dd>{{ $key->enabled }}</dd>
    </dl>

	</div>
</div>
</div>
@endsection