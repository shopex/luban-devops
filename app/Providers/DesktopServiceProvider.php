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
        if(Luban::has('apihub')){
            $menus[] = ['label'=>'开放接口', 'link'=>'open'];
        }

        view()->share('app_menus', $menus);
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
