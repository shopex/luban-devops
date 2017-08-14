@extends('adminui::layout')

@section('title', '集群')

@section('content')
<h3>集群</h3><hr />

<div class="row">
@foreach ($nodes as $node=>$items)
	<div class="col-md-3">
		<div class="panel panel-default">
		  <div class="panel-heading">{{ $node }}</div>
		  <div class="panel-body">
		    @foreach ($items as $item)
	    		<div style="padding:3px">
		    		<b>{{ $item }}</b>
	    		</div>
		    @endforeach
		  </div>
		</div>
	</div>
@endforeach
</div>


<h3>参数配置</h3><hr />

<div class="row" style="margin-bottom:50px">
@foreach ($services as $item)
		<div class="col-md-1">
			<a href="{{ url('/service/cfg') }}/{{ $item }}">		
				<b>{{ $item }}</b>
			</a>
		</div>
@endforeach

		<div class="col-md-1" id="new-cfg">
			<a href="#"><i class="glyphicon glyphicon-plus"></i></a>
			<form class="new-cfg-panel external" style="white-space: nowrap;display: none">
				<input type="text" id="new-cfg-ipt" />
				<button type="submit" class="btn btn-sm btn-default">创建配置</button>
			</form>
		</div>

</div>

<script>
$(function(){
	$('#new-cfg a').click(function(e){
		$('#new-cfg a').hide();
		$('#new-cfg .new-cfg-panel').show();
		$('#new-cfg-ipt').focus();
		e.stopPropagation();
		return false;
	});

	$('#new-cfg .new-cfg-panel').on('submit', function(e){
		var name = $('#new-cfg-ipt').val();
		if(name){
			var url = "{{ url('service/cfg') }}/"+name;
			$.loadPage(url);
		}
		e.stopPropagation();
		return false;
	})
})
</script>
@endsection