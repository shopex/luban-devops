<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    static function events(){
    	$predefined_events = [
    		['group'=>'trade', 'name'=>'交易数据', 'items'=>[
    			['code'=>'trade.add', 'name'=>'新建订单'],
    			['code'=>'trade.add', 'name'=>'订单付款'],
    			['code'=>'trade.add', 'name'=>'订单退货'],
    			['code'=>'trade.add', 'name'=>'订单退款'],
    		]],
    		['group'=>'trade', 'name'=>'商品评论', 'items'=>[
    			['code'=>'trade.add', 'name'=>'商品评论'],
    		]],
    		['group'=>'trade', 'name'=>'客服沟通', 'items'=>[
    			['code'=>'trade.add', 'name'=>'售前咨询'],
    			['code'=>'trade.add', 'name'=>'售后服务'],
    		]],
    		['group'=>'trade', 'name'=>'线上浏览行为数据', 'items'=>[
    			['code'=>'trade.add', 'name'=>'加入收藏'],
    			['code'=>'trade.add', 'name'=>'加入购物车'],    		
    			['code'=>'trade.add', 'name'=>'当日来访'],
    		]],
    		['group'=>'trade', 'name'=>'线上实体行为数据', 'items'=>[
    			['code'=>'trade.add', 'name'=>'当日来访'],
    			['code'=>'trade.add', 'name'=>'线下购物'],
    		]],
    		['group'=>'trade', 'name'=>'公众号互动数据', 'items'=>[
    			['code'=>'trade.add', 'name'=>'关注'],
    			['code'=>'trade.add', 'name'=>'访问公众号'],
    		]],
    		['group'=>'trade', 'name'=>'微博行为数据', 'items'=>[
    			['code'=>'trade.add', 'name'=>'关注'],
    			['code'=>'trade.add', 'name'=>'评论'],
    			['code'=>'trade.add', 'name'=>'转发'],
    		]],
    	];
    	return $predefined_events;
    }
}
