<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', 'dashboard@welcome');

Route::get('/input/event', 'input@event');
Route::get('/input/event/showeventgroup', 'input@event_group_get');
Route::get('/input/event/groupupdateview','input@event_group_update_view');
Route::any('/input/event/groupupdate', 'input@event_group_update');
Route::get('/input/event/groupremove','input@event_group_remove');
Route::get('/input/event/groupnewview','input@event_group_new_view');
Route::post('/input/event/groupnew','input@event_group_new');
Route::get('/input/event/newview','input@event_new_view');
Route::post('/input/event/new','input@event_create');
Route::get('/input/event/item_list','input@event_item_list');
Route::get('/input/event/remove','input@event_remove');
Route::get('/input/event/updateview','input@event_update_view');
Route::post('/input/event/update','input@event_update');
Route::get('/input/event/show','input@event_view');
//--------------------

Route::get('/service', 'service@index');
Route::get('/service/json', 'service@json');
Route::any('/service/cfg/{id}', 'service@config');
Route::any('/service/invoke', 'service@invoke');
Route::get('/nodes', 'service@nodes');

Route::get('/queue', 'queue@index');
Route::post('/queue/save', 'queue@save');

Route::get('/log', 'log@index');

Route::get('/open', 'open@api_list');
Route::any('/open/api/new', 'open@api_new');
Route::any('/open/api/edit/{id}', 'open@api_edit');
Route::any('/open/api/delete/{id}', 'open@api_delete');

Route::get('/open/pkg/', 'open@pkg_list');
Route::any('/open/pkg/new', 'open@pkg_new');
Route::any('/open/pkg/edit/{id}', 'open@pkg_edit');
Route::any('/open/pkg/delete/{id}', 'open@pkg_delete');

Route::get('/open/key/', 'open@key_list');
Route::get('/open/key/show/{id}', 'open@key_show');
Route::any('/open/key/new', 'open@key_new');
Route::any('/open/key/edit/{id}', 'open@key_edit');
Route::any('/open/key/delete/{id}', 'open@key_delete');

Route::get('/', function(){
	return redirect(url('/home'));
});
