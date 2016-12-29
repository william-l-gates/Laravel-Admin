<?php
Route::pattern('id', '[0-9]+');
Route::pattern('id2', '[0-9]+');
Route::pattern('id3', '[0-9]+');
Route::pattern('slug', '[a-zA-Z0-9-]+');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/',                       ['as' => 'admin.home',                        'uses' => 'Admin\AuthController@index']);
Route::get('login',                   ['as' => 'admin.auth.login',                  'uses' => 'Admin\AuthController@login']);
Route::post('doLogin',                ['as' => 'admin.auth.doLogin',                'uses' => 'Admin\AuthController@doLogin']);
Route::get('logout',                  ['as' => 'admin.auth.logout',                 'uses' => 'Admin\AuthController@logout']);
Route::get('dashboard',               ['as' => 'admin.dashboard',                   'uses' => 'Admin\DashboardController@index']);
Route::get('profile',                 ['as' => 'admin.profile',                     'uses' => 'Admin\DashboardController@profile']);
Route::post('profilestore',           ['as' => 'admin.profilestore',                'uses' => 'Admin\DashboardController@profilestore']);
Route::get('job_type',                ['as' => 'admin.jobType',                     'uses' => 'Admin\JobTypeController@index']);
Route::get('warehouses_right',        ['as' => 'admin.warehouseRight',              'uses' => 'Admin\WarehouseController@warehouseRight']);
Route::get('channel_right',           ['as' => 'admin.channel.rightList',            'uses' => 'Admin\ChannelController@channelRight']);


Route::group(['prefix' => 'channel'], function () {
    Route::get('/',                 ['as' => 'admin.channel',                   'uses' => 'Admin\ChannelController@index']);
    Route::get('create',            ['as' => 'admin.channel.create',            'uses' => 'Admin\ChannelController@create']);
    Route::post('store',            ['as' => 'admin.channel.store',             'uses' => 'Admin\ChannelController@store']);
    Route::get('edit/{id}',         ['as' => 'admin.channel.edit',              'uses' => 'Admin\ChannelController@edit']);
    Route::get('delete/{id}',       ['as' => 'admin.channel.delete',            'uses' => 'Admin\ChannelController@delete']);
    Route::get('suspend/{id}',      ['as' => 'admin.channel.suspend',           'uses' => 'Admin\ChannelController@suspend']);
});
Route::group(['prefix' => 'user'], function () {
    Route::get('/',                 ['as' => 'admin.user',                   'uses' => 'Admin\UserController@index']);
    Route::get('create',            ['as' => 'admin.user.create',            'uses' => 'Admin\UserController@create']);
    Route::post('store',            ['as' => 'admin.user.store',             'uses' => 'Admin\UserController@store']);
    Route::get('edit/{id}',         ['as' => 'admin.user.edit',              'uses' => 'Admin\UserController@edit']);
    Route::get('delete/{id}',       ['as' => 'admin.user.delete',            'uses' => 'Admin\UserController@delete']);
    Route::get('suspend/{id}',      ['as' => 'admin.user.suspend',           'uses' => 'Admin\UserController@suspend']);
});

Route::group(['prefix' => 'user_group'], function () {
    Route::get('/',                             ['as' => 'admin.userGroup',                             'uses' => 'Admin\UserGroupController@index']);
    Route::get('create',                        ['as' => 'admin.userGroup.create',                      'uses' => 'Admin\UserGroupController@create']);
    Route::post('store',                        ['as' => 'admin.userGroup.store',                       'uses' => 'Admin\UserGroupController@store']);
    Route::get('edit/{id}',                     ['as' => 'admin.userGroup.edit',                        'uses' => 'Admin\UserGroupController@edit']);
    Route::get('delete/{id}',                   ['as' => 'admin.userGroup.delete',                      'uses' => 'Admin\UserGroupController@delete']);
    Route::get('suspend/{id}',                  ['as' => 'admin.userGroup.suspend',                     'uses' => 'Admin\UserGroupController@suspend']);
    Route::get('detail/{id}',                   ['as' => 'admin.userGroup.detail',                      'uses' => 'Admin\UserGroupController@detail']);
    Route::post('ajaxStore',                    ['as' => 'admin.userGroup.ajaxStore',                   'uses' => 'Admin\UserGroupController@ajaxStore']);
    Route::post('ajaxChannelStore',             ['as' => 'admin.userGroup.ajaxChannelStore',            'uses' => 'Admin\UserGroupController@ajaxChannelStore']);
    Route::post('ajaxChannelRemove',            ['as' => 'admin.userGroup.ajaxChannelRemove',           'uses' => 'Admin\UserGroupController@ajaxChannelRemove']);
    Route::post('ajaxWarehouseStore',           ['as' => 'admin.userGroup.ajaxWarehouseStore',           'uses' => 'Admin\UserGroupController@ajaxWarehouseStore']);
    Route::post('ajaxWarehouseRemove',          ['as' => 'admin.userGroup.ajaxWarehouseRemove',          'uses' => 'Admin\UserGroupController@ajaxWarehouseRemove']);
    Route::post('ajaxJobTypeRightStore',        ['as' => 'admin.userGroup.ajaxJobTypeRightStore',        'uses' => 'Admin\UserGroupController@ajaxJobTypeRightStore']);
    Route::post('ajaxJobTypeRightRemove',       ['as' => 'admin.userGroup.ajaxJobTypeRightRemove',       'uses' => 'Admin\UserGroupController@ajaxJobTypeRightRemove']);
    Route::post('getJobTypeStatus',             ['as' => 'admin.userGroup.getJobTypeStatus',              'uses' => 'Admin\UserGroupController@getJobTypeStatus']);
});

Route::group(['prefix' => 'warehouses'], function () {
    Route::get('/',                 ['as' => 'admin.warehouses',                   'uses' => 'Admin\WarehouseController@indexWarehouse']);
    Route::get('create',            ['as' => 'admin.warehouses.create',            'uses' => 'Admin\WarehouseController@create']);
    Route::post('store',            ['as' => 'admin.warehouses.store',             'uses' => 'Admin\WarehouseController@store']);
    Route::get('edit/{id}',         ['as' => 'admin.warehouses.edit',              'uses' => 'Admin\WarehouseController@edit']);
    Route::get('delete/{id}',       ['as' => 'admin.warehouses.delete',            'uses' => 'Admin\WarehouseController@delete']);
    Route::get('suspend/{id}',      ['as' => 'admin.warehouses.suspend',           'uses' => 'Admin\WarehouseController@suspend']);
});
Route::group(['prefix' => 'job_type_right'], function () {
    Route::get('/',                 ['as' => 'admin.jobTypeRight',                   'uses' => 'Admin\JobTypeRightController@index']);
    Route::get('create',            ['as' => 'admin.jobTypeRight.create',            'uses' => 'Admin\JobTypeRightController@create']);
    Route::post('store',            ['as' => 'admin.jobTypeRight.store',             'uses' => 'Admin\JobTypeRightController@store']);
    Route::get('edit/{id}',         ['as' => 'admin.jobTypeRight.edit',              'uses' => 'Admin\JobTypeRightController@edit']);
    Route::get('delete/{id}',       ['as' => 'admin.jobTypeRight.delete',            'uses' => 'Admin\JobTypeRightController@delete']);
    Route::get('suspend/{id}',      ['as' => 'admin.jobTypeRight.suspend',           'uses' => 'Admin\JobTypeRightController@suspend']);
});
Route::group(['prefix' => 'job_type_status'], function () {
    Route::get('/',                 ['as' => 'admin.jobTypeStatus',                   'uses' => 'Admin\JobTypeStatusController@index']);
    Route::get('create',            ['as' => 'admin.jobTypeStatus.create',            'uses' => 'Admin\JobTypeStatusController@create']);
    Route::post('store',            ['as' => 'admin.jobTypeStatus.store',             'uses' => 'Admin\JobTypeStatusController@store']);
    Route::get('edit/{id}',         ['as' => 'admin.jobTypeStatus.edit',              'uses' => 'Admin\JobTypeStatusController@edit']);
    Route::get('delete/{id}',       ['as' => 'admin.jobTypeStatus.delete',            'uses' => 'Admin\JobTypeStatusController@delete']);
    Route::get('suspend/{id}',      ['as' => 'admin.jobTypeStatus.suspend',           'uses' => 'Admin\JobTypeStatusController@suspend']);
});
Route::group(['prefix' => 'job_type_status_flow'], function () {
    Route::get('/',                 ['as' => 'admin.jobTypeStatusFlow',                   'uses' => 'Admin\JobTypeStatusFlowController@index']);
    Route::get('create',            ['as' => 'admin.jobTypeStatusFlow.create',            'uses' => 'Admin\JobTypeStatusFlowController@create']);
    Route::post('store',            ['as' => 'admin.jobTypeStatusFlow.store',             'uses' => 'Admin\JobTypeStatusFlowController@store']);
    Route::get('edit/{id}',         ['as' => 'admin.jobTypeStatusFlow.edit',              'uses' => 'Admin\JobTypeStatusFlowController@edit']);
    Route::get('delete/{id}',       ['as' => 'admin.jobTypeStatusFlow.delete',            'uses' => 'Admin\JobTypeStatusFlowController@delete']);
    Route::get('suspend/{id}',      ['as' => 'admin.jobTypeStatusFlow.suspend',           'uses' => 'Admin\JobTypeStatusFlowController@suspend']);
    Route::post('getStatus',        ['as' => 'admin.jobTypeStatusFlow.getStatus',          'uses' => 'Admin\JobTypeStatusFlowController@getStatus']);
});
Route::group(['prefix' => 'order_items'], function () {
    Route::get('/',                     ['as' => 'admin.orderItems',                            'uses' => 'Admin\OrderItemsController@index']);
    Route::post('setProduct',           ['as' => 'admin.orderItems.setProduct',                  'uses' => 'Admin\OrderItemsController@setProduct']);
    Route::post('setInventory',         ['as' => 'admin.orderItems.setInventory',                'uses' => 'Admin\OrderItemsController@setInventory']);
});