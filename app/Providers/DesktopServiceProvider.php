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
        view()->share("app_name", config('app.name','Admin'));
        view()->share('app_menus', [
        		['label'=>'首页', 'link'=>'home'],
        		['label'=> '菜单组一', 'items'=>[
	        		['label'=>'菜单', 'link'=>'/', 'icon'=>'glyphicon-search'],
                    ['label'=>'菜单', 'link'=>'/'],
                    [],
        			['label'=>'菜单', 'link'=>'/'],
                    ['label'=>'菜单', 'link'=>'/'],
        			['label'=>'菜单', 'link'=>'/'],
        			['label'=>'菜单', 'link'=>'/'],
                    ['label'=>'菜单', 'link'=>'/'],
        		]],
        		['label'=> '菜单组二', 'items'=>[
					['label'=>'菜单', 'link'=>'/'],
					[],
        			['label'=>'菜单', 'link'=>'/'],
        			['label'=>'菜单', 'link'=>'/'],
        			[],
        			['label'=>'菜单', 'link'=>'/'],
        			['label'=>'菜单', 'link'=>'/'],
        		]],
        		['label'=> '菜单三', 'link'=>'/' ],
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