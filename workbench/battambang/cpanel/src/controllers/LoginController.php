<?php
namespace Battambang\Cpanel;

use Auth;
use Battambang\Cpanel\Validators\LoginValidator;
use Input;
use Lang;
use Redirect;
use Session;
use View;

class LoginController extends BaseController
{

    public function getIndex()
    {
        return $this->renderLayout(
            View::make(\Config::get('battambang/cpanel::views.login'))
        );
    }

    public function postIndex()
    {
        $validator = LoginValidator::make();

        if ($validator->passes()) {

            $inputs = array(
                'username' => Input::get('username'),
                'password' => Input::get('password'),
            );

            if (Auth::attempt($inputs)) {
                return Redirect::to('cpanel/package')
                    ->with('success', 'Log In Successful.');

            } else {
                return Redirect::back()
                    ->withInput()
                    ->with('login_error', 'The user name or password is not a valid.');
            }
        }

        return Redirect::back()->withInput()->withErrors($validator->instance());

    }

    public function getLogout()
    {
        if (Auth::check() == true) {
            Auth::logout();
            \UserSession::clear();
            return Redirect::to('cpanel/login')->with('logout', 'Log Out Successful.');
        }
    }

}