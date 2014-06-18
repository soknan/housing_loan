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

Route::filter(
    'auth.cpanel',
    function () {
        //Set Security
//        Battambang\Cpanel\Libraries\Security::make($securityFile = true, $ip = false, $expireDate = false);
        Battambang\Cpanel\Libraries\Security::make();

        if (Auth::check() == false) {
            return Redirect::route('cpanel.login');
        }

        if (Auth::check() and Auth::user()->getRemainDay() <= 0 and Auth::user()->getRemainDay() != 'unlimited') {
            $code = Auth::user()->id;
            Auth::logout();
            Session::put('his_code', $code);
            return Redirect::route('cpanel.login')
                ->with('error', 'Your Current User has been Expired ! Please Click this Link to ' . '<a href="' . route('cpanel.changepwd.index', array($code) ) . '">Renew Password</a>');
        }

    }
);

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

Route::filter(
    'guest.cpanel',
    function () {
        //Set Security
//        Battambang\Cpanel\Libraries\Security::make($securityFile = true, $ip = false, $expireDate = false);
        Battambang\Cpanel\Libraries\Security::make();

        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        if (!preg_match('/Chrome/i', $user_agent)) {
            return "Please use google chrome browser...";
        }

        if (Auth::check() == true) {
            return Redirect::to('cpanel/package');
        }
    }
);
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

Route::filter(
    'package.cpanel',
    function () {

        $routeNameTem = Route::current()->getName();
        list($prefix, $resource, $action) = explode('.', $routeNameTem);

        switch ($action) {
            case 'show':
                $routeName = $prefix . '.' . $resource . '.index';
                break;
            case 'store':
                $routeName = $prefix . '.' . $resource . '.create';
                break;
            case 'update':
                $routeName = $prefix . '.' . $resource . '.edit';
                break;
            case 'add': // for 'loan.disburse.add' or 'loan.disburse_client.add'
                $routeName = $prefix . '.' . $resource . '.create';
                break;
            case 'attach_update': // for 'loan.disburse.attach_update',
                $routeName = $prefix . '.' . $resource . '.attach_file';
                break;
            case 'report':
                $routeName = $prefix . '.' . $resource . '.index';
                break;
            case 'backup':
                $routeName = $prefix . '.' . $resource . '.index';
                break;
            case 'restore':
                $routeName = $prefix . '.' . $resource . '.index';
                break;
            case 'package_change': // for 'cpanel.group.package_change'
                $routeName = $prefix . '.' . $resource . '.index';
                break;
            default:
                $routeName = $routeNameTem;
                break;
        }
        $filter = in_array($routeName, UserSession::read()->permission);
        if ($filter == false) {
            return Redirect::back()
                ->with('error', Lang::get('battambang/cpanel::permissions.access_denied'));
        }
    }
);