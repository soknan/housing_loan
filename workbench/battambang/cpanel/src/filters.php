<?php

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application.
|
*/

Route::filter('auth.cpanel', function()
{
    //Set Security
    Battambang\Cpanel\Libraries\Security::make();

    if (Auth::check()==false){
        return Redirect::route('cpanel.login');
    }

    if(Auth::check() and Auth::user()->getRemainDay() <=0 and Auth::user()->getRemainDay() !='unlimited'){
        $code = Auth::user()->id;
        Auth::logout();
        Session::put('his_code',$code);
        return Redirect::route('cpanel.login')
            ->with('error', 'Your Current User has been Expired ! Please Click this Link to ' . '<a href="' .route('cpanel.changepwd',array($code)). '">Renew Password</a>');
    }

});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest.cpanel', function()
{
    //Set Security
    Battambang\Cpanel\Libraries\Security::make();

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    if (!preg_match('/Chrome/i', $user_agent)) {
        return "Please use google chrome browser...";
    }

    if (Auth::check()==true){
        return Redirect::to('cpanel/package');
    }
});
/*
|--------------------------------------------------------------------------
| Session Filter (Package)
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('package.cpanel', function()
{
/*    if (!(UserSession::read()->package) or ( Route::currentRouteName() != 'cpanel.package.home' and !(Str::startsWith(URL::current(), Config::get('battambang/cpanel::package.'.UserSession::read()->package.'.url'))))) return Redirect::to('cpanel/package');

    list($prefix,$module,$rule) = explode('.',Route::currentRouteName());

    switch($rule){
        case 'index':
        case 'show':
        case 'report':
            $userRule = 'show';
            break;
        case 'create':
        case 'store':
            $userRule = 'add';
            break;
        case 'edit':
        case 'update':
            $userRule = 'edit';
            break;
        case 'destroy':
        case 'delete':
            $userRule = 'delete';
            break;
        default:
            $userRule = $module;
            break;
    }

    if(!GetLists::hasPermissions($module,$userRule)){
        try{
            return Redirect::back()->with('error', Lang::get('battambang/cpanel::permissions.access_denied'));
        }catch (Exception $e){
            return Redirect::route('cpanel.package.home')->with('error', Lang::get('battambang/cpanel::permissions.access_denied'));
        }
    }*/
});