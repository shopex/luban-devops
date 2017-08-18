<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Shopex\Luban\Facades\Luban;

class input extends Controller
{
    public function channel(){
    	$events = \App\Events::events();   	
    	return view('input/channel', ['events'=>$events]);
    }

    public function event(){
        $groups = $this -> event_group_list();
        $events = $this -> event_list();
        
        foreach ($groups as $val){
              $group[] = ['id' => $val->id ,'name' =>$val->name, 'items'=>[]];

        }
        foreach ($events as  $val) {
                
              $item[] = ['gid'=>$val->gid, 'id'=>$val->id ,'name'=>$val->name ,'code'=>$val->code, 'descs'=>$val->descs];
            }
                         
        foreach ($group as $key => $value) {

            foreach ($item as $k => $v) {
                if($value['id'] == $v['gid']){
                    $group[$key]['items'][] = $item[$k];
                }

            }
        }
        
    	return view('input/event', ['events'=>$group]); 
    }
    

    public function trigger(){
    	return view('input/trigger');
    }

    //-------------------------------------------------------------
    //Create by Zy

    //建立事件组
    public function event_group_new(Request $req){
        if($req->method()=='POST'){
           $events = luban::s('trigger')->event_group_new([
                    'name' =>$req->input('name'),

           ]);
           if(is_int($events) && $events>0){
           return redirect('/input/event') ;
           }
        }
    }

    // 事件组查询
    public function event_group_list(){
        
           $events = luban::s('trigger')->event_group_list([]);
        
           return $events;
    }

    // 事件组更新
    public function event_group_update(Request $req){
            
           $events = luban::s('trigger')->event_group_update([
                      'id'   => $req->input('id'),
                      'name' => $req->input('name'),
           ]);
                    
           return redirect('/input/event');
           
           
      
    }

    //事件组删除
    public function event_group_remove(Request $req){
        if($req->method()=='GET'){
           $events = luban::s('trigger')->event_group_remove([
                     'id' => $req->input('id'),                     
           ]);

           }

           return redirect('/input/event');
         
        
    }

    //
    //获得 一个事件组(并显示)
    public function event_group_get(Request $req){
        if($req->method() == 'GET'){

           $events = luban::s('trigger')->event_group_get([
                     'id' => $req->input('id'),
           ]);
          
           if(is_object($events)){

              return view('input/showeventgroup',['return'=> $events]);

            }else{
                return redirect('/input/event');
            }

        }

    } 


    // 建立事件
    public function event_create(Request $req){
        if ($req->method()=='POST'){
            $events = luban::s('trigger')->event_create([
                    'gid'  => $req->input('gid'),
                    'code' => $req->input('code'),
                    'name' => $req->input('name'),
                    'descs'=> $req->input('descs'),
            ]);
            if(is_int($events) && $events>0){

            return redirect('/input/event');
            }
        }
    }

     // 更新事件
    public function event_update(Request $req){
        if ($req->method()=='POST'){
            $events = luban::s('trigger')->event_update([
                    'id'    => $req->input('id'),
                    'gid'   => $req->input('gid'),
                    'code'  => $req->input('code'),
                    'name'  => $req->input('name'),
                    'descs' => $req->input('descs'),
            ]);
            if(is_int($events) && $events>0){

            return redirect ('/input/event');
            }
        }
    }

    //查询事件
    public function event_list(){
        
           $events = luban::s('trigger')->event_list([]);
        
           return $events;
    }

    //事件删除
    public function event_remove(Request $req){
        if($req->method()=='GET'){
           $events = luban::s('trigger')->event_remove([
                     'id' => $req->input('id'),

           ]);          
            return redirect('/input/event');
          
        }
    }

    //获得 一个事件
    public function event_get(Request $req){
        if($req->method() == 'GET'){

           $events = luban::s('trigger')->event_get([
                     'id' => $req->input('id'),
           ]);

           return $events;
        }

    } 


    //建立一个item
    public function event_item_create(Request $req){
        if($req->method() == 'POST'){
           $items = luban::s('trigger')->event_item_create([
                    'event_id'   => $req->input('event_id'),
                    'name'       => $req->input('name'),
                    'field'      => $req->input('field'),
                    'field_type' => $req->input('field_type'),
           ]);

           if(is_int($items) && $items>0){
           
           return redirect('/input/event');
           
           }
        }
    }

    //查询item
    public function event_item_list(){
        $items = luban::s('trigger')->event_item_list([]);
        return view('/input/itemlist',['return' => $items]);
    }

    //更新一个item
    public function event_item_update(Request $req){
        if($req->method() =='POST'){
           $items = luban::s('trigger')->event_item_update([
                    'id'         => $req->input('id'),
                    'eventid'    => $req->input('eventid'),
                    'name'       => $req->input('name'),
                    'field'      => $req->input('field'),
                    'field_type' => $req->input('field_type'),
        ]);
        if(is_int($items) && $items>0){

        return redirect('/input/event');
            }
        }
    }

    //获得一个item
    public function event_item_get(Request $req){
        if($req->method() == 'GET'){
           $items = luban::s('trigger')->event_item_get([
                   'id' => $req->input('id'),
        ]);

        return $items;
        }

    }

    //删除一个item
    public function event_item_remove(Request $req){
        if ($req->method() =='GET'){

            $items = luban::s('trigger')->event_item_remove([
                     'id' => $req->input('id'),

            ]);

            if($items =='删除成功'){

            return redirect('/input/event');
            }
        }
    }
    //以下全部是视图控制器
    //修改一个事件组(未结束)
    public function event_group_update_view(){
        $return['id'] = $_GET['id'];
        $return['name'] = $_GET['name'];
        return view('/input/eventgroupupdate',['return'=>$return]);
    }



    //新增一个事件组视图
    public function event_group_new_view(){

      return view('/input/eventgroupnew');
    }

    //新增一个事件视图
    public function event_new_view(Request $req){
       $return['gid'] = $req->input('gid');
       $return['name'] = $req->input('gname');

       return view('/input/eventnew',['return'=> $return]);
    }

    //事件更新视图
    public function event_update_view(Request $req){
          
           $events = luban::s('trigger')->event_get([
                     'id' => $req->input('id'),
           ]);
           // echo "<pre>";
           // var_dump($events);
           // exit;

           return view('/input/eventupdate', ['return' =>$events]);


    }

    //事件查看视图
    public function event_view(Request $req){
     
      $events = luban::s('trigger')->event_get([
                     'id' => $req->input('id'),
           ]);

       // echo '<pre>';
       // var_dump($events);
       // exit;
      return view('/input/showevent',['return'=>$events]);

    }

}
