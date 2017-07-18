<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DesktopServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('app_menus', [
                ['label'=>'首页', 'link'=>'home'],            
        		['label'=>'微服务', 'link'=>'service'],
                ['label'=>'集群', 'link'=>'nodes'],
                ['label'=>'消息队列', 'link'=>'queue'],                
                // ['label'=>'日志与监控', 'link'=>'log'],
                ['label'=>'开放接口', 'link'=>'open'],
                // ['label'=>'使用手册', 'link'=>'doc'],
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