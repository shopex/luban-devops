<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Shopex\Luban\Facades\Luban;

class DesktopServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share("app_name", config('app.name','Devops'));
        
        $menus = [
                ['label'=>'首页', 'link'=>'home'],            
                ['label'=>'微服务', 'link'=>'service'],
                ['label'=>'集群', 'link'=>'nodes'],
                ['label'=>'消息队列', 'link'=>'queue'],                
            ];
        $menus[] = ['label'=> '菜单组一', 'items'=>[
                    ['label'=>'菜单', 'link'=>'/', 'icon'=>'glyphicon-search'],
                    ['label'=>'菜单', 'link'=>'/'],
                    [],
                    ['label'=>'菜单', 'link'=>'/'],
                    ['label'=>'菜单', 'link'=>'/'],
                    ['label'=>'菜单', 'link'=>'/'],
                    ['label'=>'菜单', 'link'=>'/'],
                    ['label'=>'菜单', 'link'=>'/'],
                ]];

        if(Luban::has('apihub')){
            $menus[] = ['label'=>'开放接口', 'link'=>'open'];
        }

        view()->share('app_menus', $menus);

        view()->share('searchbar', [
                ['label'=>'搜索手机号', 'action'=>'/search/phone', 'regexp'=>'^[0-9\s]+$'],
                ['label'=>'搜索邮箱', 'action'=>'/home?filters=[[1,"{{value}}","has"]]', 'regexp'=>'^[a-z0-9\.\_\+\-]+@[a-z0-9\.\_\-]+$'],
                ['label'=>'搜索用户', 'action'=>'/home?filters=[[0,"{{value}}","has"]]', 'regexp'=>'[a-z0-9\.\_\+\-]'],                
            ]);        
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    
}
