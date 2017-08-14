@extends('adminui::layout')

@section('title', '消息队列')

@section('content')
<h3>消息队列</h3><hr />
 <a href="{{url('/input/event')}}"><button class="btn btn-default">事件列表</button></a>
 <hr/>


@foreach ($groups as $group)
<div class="panel panel-default">
	<div class="panel-heading">消息组</div>
	<div class="panel-body">
		<dl class="dl-horizontal">
			<dt>Group Id</dt>
			<dd>{{ $group['id'] }}</dd>

			<dt>etcd path</dt>
			<dd>{{ $group['etcd_path'] }}</dd>

			<dt>RabbitMQ server</dt>
			<dd>
				@if(count($group['server'])>0)
					@foreach ($group['server'] as $server)
					{{$server}}
					@endforeach
				@else
					<b class="b-alert">未设置服务器信息</b>
				@endif
				<br />
				<i class="b-info">etcd: {{ $group['etcd_path'] }}/nodes/*</i>
			</dd>

			<dt>Vhost</dt>
			<dd>{{ $group['config']->vhost }}</dd>

			<dt>User</dt>
			<dd>{{ $group['config']->user }}</dd>

			<dt>webapi</dt>
			<dd>{{ $group['config']->webapi }}</dd>

			<dt>备注说明</dt>
			<dd>{{ $group['config']->notes }}</dd>
		</dl>
	</div>
</div>
@endforeach


@if(count($groups)>0)
<span class="btn btn-default" 
	onclick="$('#new-mq-grp-panel').slideDown();$(this).hide()">添加消息组</span>

<div class="panel panel-default" id="new-mq-grp-panel" style="display: none">
	<div class="panel-heading">添加消息组</div>
	<div class="panel-body">

	<form class="form-horizontal" method="POST" action="{{ url('queue/save') }}">
		<div class="form-group">
		    <label class="col-sm-2 control-label">
		    Group Id <b style="color:red">*</b>
		    </label>
		    <div class="col-sm-5">
		      <input type="text" class="form-control" name="group_id">
		    </div>
		</div>
@else
<div class="panel panel-default" id="new-mq-grp-panel">
	<div class="panel-heading">设置默认消息组</div>
	<div class="panel-body">

	<form class="form-horizontal" method="POST" action="{{ url('queue/save') }}">
		<input type="hidden" value="default" class="form-control" name="group_id">
@endif

		<div class="form-group">
		    <label class="col-sm-2 control-label">Server</label>
		    <div class="col-sm-5">
		      <input type="text" class="form-control" name="server">
		    </div>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label">Vhost <b class="b-alert">*</b></label>
		    <div class="col-sm-5">
		      <input type="text" class="form-control" value="/" name="vhost">
		    </div>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label">User <b class="b-alert">*</b></label>
		    <div class="col-sm-5">
		      <input type="text" class="form-control" value="guest" name="user">
		    </div>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label">Password</label>
		    <div class="col-sm-5">
		      <input type="password" class="form-control" name="password">
		    </div>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label">webapi <b class="b-alert">*</b></label>
		    <div class="col-sm-5">
		      <input type="text" class="form-control" name="webapi">
		    </div>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label">备注</label>
		    <div class="col-sm-5">
		      <input type="text" class="form-control" name="notes">
		    </div>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label">&nbsp;</label>
		    <div class="col-sm-5">
		      <button class="btn btn-default">确认添加</button>
		    </div>
		</div>
	</form>

	</div>
</div>
@endsection