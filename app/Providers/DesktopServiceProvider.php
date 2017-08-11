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

        view()->share('searchbar', [
                ['label'=>'搜索用户', 'action'=>'/search/user', 'regexp'=>'[a-z0-9\.\_\+\-]'],
                ['label'=>'搜索手机号', 'action'=>'/search/phone', 'regexp'=>'^[0-9\s]+$'],
                ['label'=>'搜索邮箱', 'action'=>'/search/email', 'regexp'=>'^[a-z0-9\.\_\+\-]+@[a-z0-9\.\_\-]+$'],
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