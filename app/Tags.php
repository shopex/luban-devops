<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    static function tags(){
    	$predefined_tags = [
    		['group'=>'个人信息', 'items' =>[
    			//个人信息
    			'born_location'=> ['name'=>'出生地', 'type'=>'location'],
    			'birthday'=> ['name'=>'出生日期', 'type'=>'time'],
    			'resided_location'=> ['name'=>'居住地', 'type'=>'location'],
    			'resided_time'=> ['type'=>'time', 'name'=>'定居时间'],
    			'gender' => ['name'=>'性别', 'type'=>'select', 'options'=>[
    				'1'=>'男', '2'=>'女', '3'=>'保密',
    			]],
    			'height' => ['name'=>'身高', 'type'=>'number'],
    			'weight' => ['name'=>'体重', 'type'=>'number'],
    			'constellation' => ['name'=>'星座', 'type'=>'select', 'options'=>[
    				
    			]],
    			'abo_blood' => ['name'=>'血型', 'type'=>'select', 'options'=>[
    				'1'=>'A', '2'=>'B', '3'=>'O', '4'=>'AB'
    			]],
			]],
			['group'=>'联系信息', 'items'=> [
    			'cellphone' => ['name'=>'手机号', 'type'=>'string'],
    			'cellphone_time' => ['name'=>'手机号使用时间', 'type'=>'time'],
    			'phone' => ['name'=>'固定电话', 'type'=>'string'],
    			'email' => ['name'=>'电子邮件', 'type'=>'string'],
    			'weibo_id' => ['name'=>'微博帐号', 'type'=>'string'],

    			'wechat_id' => ['name'=>'微信id', 'type'=>'string'],
    			'wechat_nick' => ['name'=>'微信昵称', 'type'=>'string'],
    			'wechat_avator' => ['name'=>'微信头像', 'type'=>'string'],
			]],
			['group'=>'工作信息', 'items'=>[
    			'career_type' => ['name'=>'工作类型', 'type'=>'select', 'options'=>[
    				'1'=>'厅局级以上', '2'=>'初级', '3'=>'科技', '4'=>'一般干部', 
    				'5'=>'企业负责人', '6'=>'中层管理', '7'=>'一般管理', '8'=>'一般员工',  '9'=>'其他', 
    			]],
    			'trades' => ['name'=>'单位性质', 'type'=>'select', 'options'=>[
    				'1'=>'机关,事业单位', '2'=>'国有企业', '3'=>'外商独资企业', '4'=>'中外合资/合作企业', 
    				'5'=>'股份制企业', '6'=>'私营企业', '9'=>'其他', 
    			]],
    			'firm_size' => ['name'=>'企业规模', 'type'=>'select', 'options'=>[
    				'1'=>'20人以下', '2'=>'20-50人', '3'=>'51-100人', '4'=>'101-500人', 
    				'5'=>'501-1000人', '6'=>'1001-5000人', '9'=>'5000人以上', 
    			]],
			]],	
    		['group'=>'家庭信息', 'items' =>[
    			//社会信息
    			'marital_status' => ['name'=>'婚姻状况', 'type'=>'select', 'options'=>[
    				'1'=>'已婚', '2'=>'未婚'
    			]],
    			'family_income' => ['name'=>'家庭月收入', 'type'=>'select', 'options'=>[
    				
    			]],
    			'has_pet' => ['name'=>'宠物状况', 'type'=>'select', 'options'=>[
    				'1'=>'有宠物', '2'=>'无宠物'
    			]],
    			'parents' => ['name'=>'父母状况', 'type'=>'select', 'options'=>[
    				'1'=>'同住', '2'=>'非同住', '4'=>'其他'
    			]],
    			'housing' => ['name'=>'居住情况', 'type'=>'select', 'options'=>[
    				'1'=>'自有房屋', '2'=>'租房', '3'=>'宿舍', '4'=>'借宿'
    			]],
    			'living_space' => ['name'=>'住房面积', 'type'=>'select', 'options'=>[
    				'1'=>'60以下', '2'=>'60-80', '3'=>'80-100', '4'=>'100-150', 
    				'5'=>'150-300', '6'=>'300以上',
    			]],
    			'children' => ['name'=>'子女数', 'type'=>'number'],
				'child_birthday_1'=> ['name'=>'第一个孩子的出生日期', 'type'=>'time'],
				'child_birthday_2'=> ['name'=>'第二个孩子的出生日期', 'type'=>'time'],
				'child_birthday_3'=> ['name'=>'第三个孩子的出生日期', 'type'=>'time'],
    			'pregnant_time'=> ['name'=>'如果有孕妇, 孕妇怀孕时间', 'type'=>'time'],				
    		]]
    	];
    	return $predefined_tags;
    }
}
