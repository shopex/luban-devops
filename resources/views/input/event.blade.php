 @extends('layouts.app')

@section('title', 'Page Title')


@section('content')
<div class="panel panel-default">
<div class="panel-body">
<a href="{{url('/input/event/groupnewview')}}" class="btn btn-large">新增事件组</a>
<a href="{{url('/input/event/item_list')}}" class="btn btn-large">ITEM 列表(开发者看的，不是正式列表)</a>
</div>
</div>
		
	@foreach ($events as $group)
		<div class="panel panel-default">
		  <div class="panel-heading">{{$group['name']}} 【<a href="{{url('/input/event/newview'.'?gid='.$group['id'].'&gname='.$group['name'])}}">新建事件</a>】
		  <div class="pull-right">
				<a href="{{url('/input/event/groupremove'.'?id='.$group['id'])}}" class= "btn btn-large">删除事件组</a>
			</div>
			<div class="pull-right">
				<a href="{{url('/input/event/showeventgroup'.'?id='.$group['id'])}}" class= "btn btn-large">查看事件组</a>
			</div>
			
			<div class="pull-right">
				<a href="{{url('/input/event/groupupdateview'.'?id='.$group['id'].'&name='.$group['name'])}}" class = "btn btn-large">修改事件组</a>
			</div>		

		  </div>
		  <div class="panel-body">
			   @foreach ($group['items'] as $item)
					<div><a href="{{url('/input/event/item/list'.'?eventId='.$item['id'])}}" title="点击查看下级item列表">{{$item['name']}}</a>
					<div class="pull-right">
					 <a href="{{url('/input/event/remove'.'?id='.$item['id'])}}">删除</a>

					 <a href="{{url('/input/event/updateview'.'?id='.$item['id'])}}">修改</a>						
					 <a href="{{url('/input/event/show'.'?id='.$item['id'])}}">查看</a>
					 </div>




					</div> 
			   @endforeach
		  </div>
		</div>	
	@endforeach
@endsection