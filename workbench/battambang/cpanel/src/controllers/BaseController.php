<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/10/14
 * Time: 3:30 PM
 */

namespace Battambang\Cpanel;

use Battambang\Loan\Office;
use Controller,
    View,
    DB,
    Config,
    Redirect,
    Session,
    Route,
    UserSession;

class BaseController extends Controller
{
    //protected $layout = "battambang/cpanel::layout.default.master";
    public function renderLayout($view)
    {
        $this->layout = $view;
        $this->layout->title = 'Microfis';
        $this->layout->package = $this->getPackageName();
        $this->layout->hiUser = $this->getHiUser();
        $this->layout->nowDate = date("l, d-F-Y", time());
        $this->layout->actionBtn = $this->getActionBtn();
        $this->layout->footer = $this->getFooter();
    }

    protected function getPackageName()
    {

        if (UserSession::read()->package) {
            $tmp = ' <a class="navbar-brand" href="' . route('cpanel.package.home') . '">';
            $tmp .= Config::get('battambang/cpanel::package.' . UserSession::read()->package . '.name');
            $tmp.= ' [ '.\Battambang\Cpanel\Office::find(\UserSession::read()->sub_branch)->en_short_name.' ]';
            $tmp .= '</a>';
        } else {
            $tmp = '<a class="navbar-brand" href="' . route('cpanel.package') . '">Microfis</a>';
        }

        return $tmp;
    }

    protected function getHiUser()
    {
        if (\Auth::check()) {
            $user = \Auth::user()->last_name . ' ' . \Auth::user()->first_name;
            $tmp = \Auth::user()->getRemainDay();
            if (\Auth::user()->getRemainDay() != 'unlimited') {
                $tmp = \Auth::user()->getRemainDay() . ' Day(s)';
            }
            $userInfo = '<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> ' . $user . ' [ ' . ucwords($tmp) . ' ] <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="' . route('cpanel.changepwd.index') . '"><span class="glyphicon glyphicon-lock"></span> Change Password</a></li>
                        </ul>
                    </li>';
            return $userInfo;
        }
    }

    protected function getActionBtn()
    {
        $list = explode('.', Route::currentRouteName());

        if (isset($list[2]) and ($list[2] == 'index')) {
            return $this->getConfigByPackage('action_btn.' . $list[1]);
        }
        return '';
    }

    protected function getFooter()
    {
        return 'COPYRIGHT &copy; ' . date('Y', time());
    }

    protected function getConfigByPackage($name)
    {
        if (UserSession::read()->package) {
            return Config::get(
                Config::get('battambang/cpanel::package.' . UserSession::read()->package . '.namespace') . '::' . $name
            );
        }
        return '';
    }


    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    protected function getValidationService($service, array $inputs = array())
    {

        if (UserSession::read()->package) {
            $class = '\\' . ltrim($this->getConfigByPackage('validation.' . "{$service}"), '\\');

        } else {
            $class = '\\' . ltrim(Config::get('battambang/cpanel::validation.' . "{$service}"), '\\');
        }

        return new $class($inputs);
    }
} 