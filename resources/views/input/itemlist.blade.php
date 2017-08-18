@extends('admin::layout')

@section('title', '查看ITEM列表')

@section('content')
ITEM 列表  <a href="{{url('/input/event')}}" >返回列表页</a>
<?php echo "<pre>"; ?>

{{var_dump($return)}}


@endsection