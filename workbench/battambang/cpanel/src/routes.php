<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/10/14
 * Time: 3:08 PM
 */

Route::get('/',function(){
    return Redirect::to('cpanel/package');
});

/*
|--------------------------------------------------------------------------
| Login, Logout Routes
|--------------------------------------------------------------------------
|
|
*/
Route::group(array('prefix' => 'cpanel','before' => 'guest.cpanel'),function () {
        Route::get('login', array(
            'as' => 'cpanel.login',
            'uses' => 'Battambang\Cpanel\LoginController@getIndex',
        ));
        Route::post('login', 'Battambang\Cpanel\LoginController@postIndex');
});

Route::get('cpanel/logout', array(
    'as' => 'cpanel.logout',
    'uses' => 'Battambang\Cpanel\LoginController@getLogout',
    'before' => 'auth.cpanel'
));

Route::group(array('prefix' => 'cpanel','before' => 'auth.cpanel'),function () {
    Route::get('package',array(
        'as'=>'cpanel.package',
        'uses'=>'Battambang\Cpanel\HomeController@getIndex'
    ));
    Route::post('package', 'Battambang\Cpanel\HomeController@postIndex');
    Route::get('home',array(
        'as'=>'cpanel.package.home',
        'uses'=>'Battambang\Cpanel\WelcomeController@getIndex',
        /*'before' => 'package.cpanel',*/
    ));

    // Home Page (user group onChange)
    Route::post('package/group_change', 'Battambang\Cpanel\HomeController@postGroupChange');
//    Route::post('package/branch_change', 'Battambang\Cpanel\HomeController@postBranchChange');
//    Route::get('package/package-change/{package}', 'Battambang\Cpanel\HomeController@getPackageChange');
//    Route::get('package/branch-change/{branch}/{package}', 'Battambang\Cpanel\HomeController@getBranchChange');
});

Route::group(array('prefix' => 'cpanel','before' => 'auth.cpanel|package.cpanel'),function () {
/*
 * User
 */
    Route::get('user',array(
        'as'=>'cpanel.user.index',
        'uses'=>'Battambang\Cpanel\UserController@index',
    ));
    Route::post('user',array(
        'as'=>'cpanel.user.store',
        'uses'=>'Battambang\Cpanel\UserController@store',
    ));
    Route::get('user/create',array(
        'as'=>'cpanel.user.create',
        'uses'=>'Battambang\Cpanel\UserController@create',
    ));
    Route::get('user/{id}/edit',array(
        'as'=>'cpanel.user.edit',
        'uses'=>'Battambang\Cpanel\UserController@edit',
    ));
    Route::put('user/update/{id}',array(
        'as'=>'cpanel.user.update',
        'uses'=>'Battambang\Cpanel\UserController@update',
    ));
    Route::delete('user/destroy/{id}',array(
        'as'=>'cpanel.user.destroy',
        'uses'=>'Battambang\Cpanel\UserController@destroy',
    ));

/*
 * Company
 */
    Route::get('company/{id}/edit',array(
        'as'=>'cpanel.company.edit',
        'uses'=>'Battambang\Cpanel\CompanyController@edit',
    ));
    Route::put('company/update/{id}',array(
        'as'=>'cpanel.company.update',
        'uses'=>'Battambang\Cpanel\CompanyController@update',
    ));

/*
 * Office
 */
    Route::get('office',array(
        'as'=>'cpanel.office.index',
        'uses'=>'Battambang\Cpanel\OfficeController@index',
    ));
    Route::get('office/create',array(
        'as'=>'cpanel.office.create',
        'uses'=>'Battambang\Cpanel\OfficeController@create',
    ));
    Route::get('office/{id}/edit',array(
        'as'=>'cpanel.office.edit',
        'uses'=>'Battambang\Cpanel\OfficeController@edit',
    ));
    Route::put('office/update/{id}',array(
        'as'=>'cpanel.office.update',
        'uses'=>'Battambang\Cpanel\OfficeController@update',
    ));
    Route::delete('office/destroy/{id}',array(
        'as'=>'cpanel.office.destroy',
        'uses'=>'Battambang\Cpanel\OfficeController@destroy',
    ));
    Route::get('office/show/{id}',array(
        'as'=>'cpanel.office.show',
        'uses'=>'Battambang\Cpanel\OfficeController@show',
    ));
    Route::post('office',array(
        'as'=>'cpanel.office.store',
        'uses'=>'Battambang\Cpanel\OfficeController@store',
    ));

/*
 * Group
 */
    Route::get('group',array(
        'as'=>'cpanel.group.index',
        'uses'=>'Battambang\Cpanel\GroupController@index'
    ));
    Route::get('group/create',array(
        'as'=>'cpanel.group.create',
        'uses'=>'Battambang\Cpanel\GroupController@create'
    ));
    Route::post('group',array(
        'as'=>'cpanel.group.store',
        'uses'=>'Battambang\Cpanel\GroupController@store',
    ));
    Route::get('group/{id}/edit',array(
        'as'=>'cpanel.group.edit',
        'uses'=>'Battambang\Cpanel\GroupController@edit'
    ));
    Route::put('group/update/{id}',array(
        'as'=>'cpanel.group.update',
        'uses'=>'Battambang\Cpanel\GroupController@update'
    ));
    Route::delete('group/destroy/{id}',array(
        'as'=>'cpanel.group.destroy',
        'uses'=>'Battambang\Cpanel\GroupController@destroy'
    ));

    // Group Page (package onChange to)
    Route::post('group/package_change', 'Battambang\Cpanel\GroupController@postPackageChange');
/*
 * Decode Text
 */
    Route::get('decode',array(
        'as' => 'cpanel.decode.index',
        'uses'=>'Battambang\Cpanel\DecodeTextController@index',
    ));

/*
 * Work Day
 */
    Route::get('workday',array(
        'as' => 'cpanel.workday.index',
        'uses'=>'Battambang\Cpanel\WorkDayController@index',
    ));
    Route::get('workday/create',array(
        'as' => 'cpanel.workday.create',
        'uses'=>'Battambang\Cpanel\WorkDayController@create',
    ));
    Route::get('workday/{id}/edit',array(
        'as' => 'cpanel.workday.edit',
        'uses'=>'Battambang\Cpanel\WorkDayController@edit',
    ));
    Route::put('workday/update/{id}',array(
        'as' => 'cpanel.workday.update',
        'uses'=>'Battambang\Cpanel\WorkDayController@update',
    ));
    Route::delete('workday/destroy/{id}',array(
        'as' => 'cpanel.workday.destroy',
        'uses'=>'Battambang\Cpanel\WorkDayController@destroy',
    ));
    Route::post('workday',array(
        'as' => 'cpanel.workday.store',
        'uses'=>'Battambang\Cpanel\WorkDayController@store',
    ));

});

/*
 * DataTable Index
 */
Route::get('api/user',array(
    'as'=>'api.user',
    'uses'=>'Battambang\Cpanel\UserController@getDatatable'
));
Route::get('api/group',array(
    'as'=>'api.group',
    'uses'=>'Battambang\Cpanel\GroupController@getDatatable'
));
Route::get('api/office',array(
    'as'=>'api.office',
    'uses'=>'Battambang\Cpanel\OfficeController@getDatatable'
));
Route::get('api/workday',array(
    'as'=>'api.workday',
    'uses'=>'Battambang\Cpanel\WorkDayController@getDatatable'
));

/*
 * Change Password User
 */
Route::get('cpanel/changepwd',array(
    'as' =>'cpanel.changepwd.index',
    'uses'=>'Battambang\Cpanel\UserController@changePwd',
));
Route::post('cpanel/changepwd',array(
    'uses'=>'Battambang\Cpanel\UserController@postChangePwd',
));