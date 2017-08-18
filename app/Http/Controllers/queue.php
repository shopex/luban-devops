<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Shopex\Luban\Facades\Luban;

class queue extends Controller
{
    public function index(){
    	$bus = Luban::bus();

    	if(!$bus->dirExists('/luban/mq')){
    		$bus->createDir('/luban/mq');
    	}

		$n = $bus->dirInfo('/luban/mq');
		$groups = [];

		if(isset($n['node']['nodes'])){
			foreach($n['node']['nodes'] as $item){
				if($item['dir']){
					$group = [
						'id'=>basename($item['key']), 
						'etcd_path' => $item['key'],
						'server' => [],
						];
					$config = $bus->get($item['key'].'/config');
					$group['config'] = json_decode($config);
					$l = $bus->dirInfo($item['key'].'/nodes');
					if(isset($l['node']['nodes'])){
						foreach($l['node']['nodes'] as $h){
							$group['server'][] = basename($h['key']);
						}
					}
					$groups[] = $group;
				}
			}
		}

    	return view('queue/index', compact('groups'));
    }

    public function save(Request $req){
    	$group_id = $req->input('group_id');
    	$group_id = str_replace('/', '_', $group_id);

    	$etcd_path = 'luban/mq/'.$group_id;

    	$bus = Luban::bus();
    	if($bus->dirExists($etcd_path)){
    		return redirect('/queue');
    	}

    	$config = [
	    	'vhost' => $req->input('vhost'),
	    	'user' => $req->input('user'),
	    	'password' => $req->input('password'),
	    	'webapi' => $req->input('webapi'),
	    	'notes' => $req->input('notes'),
    	];
    	$bus->create($etcd_path.'/config', json_encode($config));
    	$bus->createDir($etcd_path.'/nodes');

    	$server = $req->input('server');
    	if($server){
    		foreach(preg_split('/[\s,;]+/', $server) as $host){
    			$bus->create($etcd_path.'/nodes/'.$host, 'ok');
    		}
    	}

    	return redirect('/queue');
    }
}
