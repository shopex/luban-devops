<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Shopex\Luban\Facades\Luban;

class open extends Controller
{

    function __construct(){
        $this->middleware(function ($request, $next) {
            if( Luban::has('apihub') == false ){
                abort(404);
            }

            if( Luban::available('apihub') == false){
                return response(view('open/closed'));
            }
            return $next($request);
        });
    }

    public function api_list(){
    	$pkgs = Luban::s('apihub')->package_list([]);
		$apis = Luban::s('apihub')->api_list([]);

		$pkg_map = [];
		foreach($pkgs as $i=>$pkg){
			$pkg_map[$pkg->id] = &$pkgs[$i];
			$pkg->apis = [];
		}

		foreach($apis as $api){
			$pkg_map[$api->packageId]->apis[] = $api;
		}
    	return view('open/api/index', compact('pkgs'));
    }

    public function api_new(Request $req){
    	if($req->method()=='POST'){
    		$code = $req->input('api_code');
    		if(!$code){
    			$code = $req->input('default_api_code'); 
    		}

    		$title = $req->input('api_title');
    		if(!$title){
    			$title = $req->input('default_api_title'); 
    		}

			$params = [];

    		$param_key = $req->input('param_key');
    		$param_desc =  $req->input('param_desc');
    		$param_type =  $req->input('param_type');
    		$param_value =  $req->input('param_value');
    		$param_required =  $req->input('param_required');
    		$param_hidden =  $req->input('param_hidden');
    		foreach((array)$param_key as $i => $key){
    			$params[$i] = [
    				'key'=>$param_key[$i],
    				'desc'=>$param_desc[$i],
    				'type'=>$param_type[$i],
    				'value'=>$param_value[$i],
    				'required'=>$param_required[$i],
    				'hidden'=> isset($param_hidden[$i])?true:false,
    			];
    		}
    		$param_map_str = json_encode($params, JSON_UNESCAPED_UNICODE);

    		$api_id = Luban::s('apihub')->api_new([
    				'code'=>$code,
    				'title'=>$title,
    				'package_id'=>$req->input('package_id'),
    				'backend'=>$req->input('backend'),
    				'backend_method'=>$req->input('backend_method'),
    				'param_map'=>$param_map_str,
    				'doc'=>$req->input('doc'),
    				'enabled'=>$req->input('enabled') ? 1 : 0,
    			]);
    		if($api_id){
    			return redirect('open/');
    		}
    	}

		$pkgs = Luban::s('apihub')->package_list([]);

    	return view('open/api/new', compact('pkgs'));
    }

    /*--------------------------------------------------------*/

    public function pkg_list(){
		$pkgs = Luban::s('apihub')->package_list([]);
    	return view('open/pkg/index', compact('pkgs'));
    }

    public function pkg_new(Request $req){
    	if($req->method()=='POST'){
    		$pkg_id = Luban::s('apihub')->package_new([
    				'code'=>$req->input('code'),
    				'name'=>$req->input('name'),
    				'subject'=>$req->input('subject'),
    				'doc'=>$req->input('doc'),
    			]);
    		if($pkg_id){
    			return redirect('open/pkg/');
    		}
    	}
    	return view('open/pkg/new');
    }

    /*--------------------------------------------------------*/

    public function key_list(){
		$keys = Luban::s('apihub')->key_find([
			]);
    	return view('open/key/index', compact('keys'));
    }

    public function key_new(Request $req){
    	if($req->method()=='POST'){
    		$key_id = Luban::s('apihub')->key_new([
    				'notes'=>$req->input('notes'),
    				'data'=>$req->input('data'),
    				'expired'=>$req->input('expired'),
    				'enabled'=>$req->input('enabled'),
    			]);
    		if($key_id){
    			return redirect('open/key/show/'.$key_id);
    		}
    	}
    	return view('open/key/new');
    }

    public function key_show($id){
    	$key = Luban::s('apihub')->key_get(['apikey'=>$id]);
    	return view('open/key/show', compact('key'));
    }

    public function key_edit(){
    	$key = Luban::s('apihub')->key_get(['apikey'=>$id]);
    	return view('open/key/show', compact('key'));
    }

    public function key_delete(){
    	return view('open/key/delete');
    }
}
