@extends('admin::layout')

@section('title', '参数配置')

@section('content')
<style>
.config-panel .row{
	margin:10px 0;
}
.config-panel input{
	width:100%;
}
</style>

<form class="col-md-8 config-panel" method="POST">
	<div class="panel panel-default">
		<div class="panel-heading">参数配置 - {{ $id }}</div>
		<div class="panel-body">
			<div id="cfg-all-rows">

			@foreach ($config as $k=>$v)
				<div class="row">
					<div class="col-md-4"><input name="key[]" type="string" value="{{ $k }}"></div>
					<div class="col-md-8"><input name="value[]" type="string" value="{{ $v }}"></div>
				</div>
			@endforeach

			<div id="cfg-rows-tmpl">
				<div class="row">
					<div class="col-md-4"><input name="key[]" type="string"></div>
					<div class="col-md-8"><input name="value[]" type="string"></div>
				</div>

				<div class="row">
					<div class="col-md-4"><input name="key[]" type="string"></div>
					<div class="col-md-8"><input name="value[]" type="string"></div>
				</div>

				<div class="row">
					<div class="col-md-4"><input name="key[]" type="string"></div>
					<div class="col-md-8"><input name="value[]" type="string"></div>
				</div>
			</div>
		</div>

			<div class="row">
				<div class="col-md-12">
					<a href="#" class="external" id="new-cfg-rows">新增配置项</a>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<button class="btn btn-default">保存配置</button>
		</div>
	</div>
</form>

<script>
$(function(){
	$('#new-cfg-rows').click(function(e){
		var els = $('#cfg-rows-tmpl .row').clone();
		$('input', els).val('');
		els.appendTo('#cfg-all-rows');
		return false;
	})
})
</script>

@endsection