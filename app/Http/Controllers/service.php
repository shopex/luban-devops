<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Shopex\Luban\Luban;
use Shopex\Luban\BackendException;
use Hprose\Future;

class service extends Controller
{
    public function index(){
    	return view('service/index');
    }

	public function json()
	{
		$srvs = Luban::services();

		// $t1 = time();
		// Luban::s('apihub')->doc();
		// var_dump(time() - $t1);exit;

		$rst = Future\value($srvs)->map(function($srv){
			try{
				return Luban::s($srv)->setTimeout(1000)->doc();
			}catch(BackendException $e){
				return false;
			}catch(\Exception $e){
				return ["error"=>$e->getMessage()];
			}
		});

		$result = [];
		$rst->then(function($r) use (&$result){
			$result = $r;
		});

		foreach($srvs as $i => $k){
			$docs[$k] = $result[$i];
		}

		return $docs;
	}

	public function config(Request $req, $id){
		if($req->method()=='POST'){
			$values = $req->input('value');
			$bus = Luban::bus();
			if(!$bus->dirExists('/luban/config/'.$id)){
				$bus->createDir('/luban/config/'.$id);
			}else{
				$cfg_map = $bus->getKeyValueMap('/luban/config/'.$id);
				foreach($cfg_map as $k=>$v){
					$bus->remove($k);
				}
			}

			foreach($req->input('key') as $i=>$k){
				if($k){
					$bus->create('/luban/config/'.$id.'/'.$k, $values[$i]);
				}
			}
		}

		$config = [];
		try{
			$cfg_map = Luban::bus()->getKeyValueMap('/luban/config/'.$id);
			foreach($cfg_map as $k=>$v){
				$k = substr($k, strlen('/luban/config/'.$id)+1);
				$config[$k] = $v;
			}
		}catch (\Exception $e) {
		}
		return view('service/config', ['id'=>$id, 'config'=>$config]);
	}

	public function nodes(){
		$nodes = Luban::nodes();
		$bus = Luban::bus();
		$services = [];

		$n = $bus->dirInfo('/luban/nodes');
		foreach($n['node']['nodes'] as $srv){
			if($srv['dir']){
				$srvname = basename($srv['key']);
				$services[$srvname] = $srvname;
			}
		}

		$n = $bus->dirInfo('/luban/config');
		foreach($n['node']['nodes'] as $srv){
			if($srv['dir']){
				$srvname = basename($srv['key']);
				$services[$srvname] = $srvname;
			}
		}
		sort($services);

		return view('service/nodes', ['nodes'=>$nodes, 'services'=>$services]);
	}

	public function invoke(){
		try{
			$service = $_POST['service'];
			$input = isset($_POST['input'])?$_POST['input']:[];
			$func = $_POST['func'];
			if(isset($_FILES['input']) && isset($_FILES['input']['tmp_name'])){
				foreach ($_FILES['input']['tmp_name'] as $key => $value) {
					$input[$key] = file_get_contents($value);
				}
			}
			$response = Luban::s($service)->$func($input);
		}catch(\Exception $e){
			$response = array(
					"error" => true,
					'message' => $e->getMessage(),
				);
		}
		return json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	}
}
