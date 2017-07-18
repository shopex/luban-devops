<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>@yield('title') - 开发平台</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">    
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script src="{{ mix('/js/app.js') }}"></script>    
  </head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#">开发平台</a>
	    </div>
	    <div id="navbar" class="navbar-collapse collapse">
	      <ul class="nav navbar-nav hide-in-search">
	      	@foreach ($app_menus as $menu)
	      	@if (isset($menu['items']) && count($menu['items']) > 0)
	        <li class="dropdown">
	          <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	          {{$menu['label']}} <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	          	@foreach ($menu['items'] as $item)
		          	@if (isset($item['label']))
			          	<li>
			          	<a href="{{ url($item['link']) }}">
			          	@if (isset($item['icon']))
			          	<i class="glyphicon {{ $item['icon'] }}"></i>
			          	@else
			          	<i style="display:inline-block;width:1em"></i>
			          	@endif
			          	{{$item['label']}}
			          	</a>
			          	</li>
		          	@else
			          	<li role="separator" class="divider"></li>
		          	@endif
	          	@endforeach
	          </ul>
	        </li>
	      	@else	        
			<li><a href="{{ url($menu['link']) }}">{{$menu['label']}}</a></li>	        
	        @endif
			@endforeach
	      </ul>

	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="#">
	        	<i class="glyphicon glyphicon-log-out"></i>
	        退出</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>

	<script>
	$(function(){
		window._search_ipt_w = $('#search-ipt').width();
		window._search_ipt_v = 0;

		$('#search-panel').css('left', $('#search-ipt').position().left);

		$('#search-ipt').on('focus', function(){
			$('#navbar .hide-in-search').hide();
			$('#search-ipt').select();
			$('#search-ipt').animate({width: $('.container').width() / 2}, 300, function(){
				$('#search-panel').css('top', $('#search-ipt').outerHeight());
				$('#search-panel').width($('#search-ipt').outerWidth());
				$('.search-value-mapper').html($('#search-ipt').val());
				$('#search-panel').show();
			});
		})
		$('#search-ipt').on('blur', function(){
			window._search_ipt_v = 0;
			$('#search-panel').hide();
			$('#search-ipt').animate({width: window._search_ipt_w}, 300, function(){
				$('#navbar .hide-in-search').show();
			});
		})
		$('#search-ipt').on('keyup', function(){
			window._search_ipt_v++;
			setTimeout( 
				(function(){
					if(window._search_ipt_v == this.v){
						$('.search-value-mapper').html($('#search-ipt').val());
					}
				}.bind({v: window._search_ipt_v})), 200);
		})
	})
	</script>

    <div class="container main-content">
		@yield('content')
    </div>

	<div class="footer">
		<div>鲁班 - 高性能电商架构</div>
		&copy;2017 上海商派网络科技有限公司
	</div>
</html>