@extends('layouts.app')

@section('title', '自动化动作')

@section('content')
 <ol class="breadcrumb">
  <li>数据集成</li>
  <li class="active">自动化动作</li>
</ol>

<table class="table">
<tr>
	<td>
		<input type="checkbox" />
	</td>
	<td>
		匹配: 线上订单下单<br />
		动作: 打标签: 线上客户
	</td>
	<td>
		<a href="">修改</a>
		<a href="">删除</a>
	</td>
</tr>
<tr>
	<td>
		<input type="checkbox" />
	</td>
	<td>
		匹配: 线下门店到店<br />
		动作: 打标签: 线下客户
	</td>
	<td>
		<a href="">修改</a>
		<a href="">删除</a>
	</td>
</tr>
</table>
@endsection