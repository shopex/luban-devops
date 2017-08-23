<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Shopex\LubanAdmin\Finder;

use Illuminate\Support\Facades\DB;
use App\User;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    	$dataSet = User::class;

    	$finder = Finder::new($dataSet, '标题')
    				->setId('id')
    				->addAction('旋转', [$this, 'action_1'])->newWindow()
    				->addAction('跳跃', [$this, 'action_2'])->modal()
    				->addAction('奔跑', [$this, 'action_2'])->modalSmall()
    				->addAction('卧倒', [$this, 'action_2'])->modalLarge()
    				->addAction('打滚', [$this, 'action_2'])
    				->addSort('按修改时间倒排', 'created_at', 'desc')
    				->addSort('按修改时间正排', 'created_at')
    				->addColumn('姓名', 'name')->size(2)->modifier(function($str){
    					return strtoupper($str);
    				})
    				->addColumn('邮箱', 'email')->size(6)
    				->addColumn('创建时间', 'created_at')->size(2)
    				->addBatchAction('批量操作1', [$this, 'bat_action_1'])->newWindow()
    				->addBatchAction('批量操作2', [$this, 'bat_action_2'])
    				->addTab("低优先级", [
    						['id','<','100'],
    					])
    				->addTab("高优先级", [
    						['id','>=','100'],
    						['id','<','520']
    					])
    				->addTab("考试不及格", [
    						['id','>=','520'],
    					])

    				->addSearch('姓名', 'name', 'string')
    				->addSearch('姓名', 'name', 'number')
    				->addSearch('姓名', 'name')
    				->addSearch('姓名', 'name', 'date')
    				->addSearch('姓名', 'name', 'string')
    				->addSearch('姓名', 'name', 'number')

    				->addInfoPanel('基本信息', [$this, 'info_basic'])
    				->addInfoPanel('家庭地址', [$this, 'info_address']);

        return $finder->view('xxxx');
    }

    // function 

    function info_basic($id){
    	return __FUNCTION__.$id.'<b>asdfas</b><script>console.info(123)</script>';
    }

    function info_address($id){
    	return __FUNCTION__.$id;
    }

	// function 

    public function action_1(){
    	return __FUNCTION__;
    }

    public function action_2(){
    	return __FUNCTION__;
    }

	// function 
	
    public function bat_action_1($id){
    	return __FUNCTION__.implode($id,',');
    }

    public function bat_action_2($id){
    	return __FUNCTION__.implode($id,',');
    }

}