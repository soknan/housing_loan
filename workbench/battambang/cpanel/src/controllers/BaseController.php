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
        $this->layout->breadcrumb = $this->getBreadcrumb();
        $this->layout->nowDate = date("l, d-F-Y", time());
        $this->layout->header = $this->getHeader();
        $this->layout->headerInfo = $this->getHeaderInfo();
        $this->layout->actionBtn = $this->getActionBtn();
        $this->layout->footer = $this->getFooter();
    }

    protected function getPackageName()
    {

        if (UserSession::read()->package) {
            $tmp = ' <a class="navbar-brand" href="' . route('cpanel.package.home') . '">';
            $tmp .= Config::get('battambang/cpanel::package.' . UserSession::read()->package . '.name');
            $tmp.= ' ['.\Battambang\Cpanel\Office::find(\UserSession::read()->sub_branch)->en_short_name.']';
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
//            $tmp = '<li class="dropdown">
//                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
//                                Hi ' . \Auth::user()->username . ' [ ' . $tmp . ' ] !<b class="caret"></b>
//                            </a>
//                            <ul class="dropdown-menu"><li><a href="' . route('cpanel.changepwd') . '">Change Password</a></li></ul>
//                        </li>';
            // Check package session
//            if (is_null(UserSession::read()->package)) {
//                $userInfo = '<li><a href="#" title="Please click [Go] to change password.">' . $user . ' [ ' . ucwords($tmp) . ' ] !</a></li>';
//            } else {
//                $userInfo = '<li><a href="' . route('cpanel.changepwd.index') . '" title="Change password">Hi ' . $user . ' [ ' . $tmp . ' ] !</a></li>';
                $userInfo = '<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> ' . $user . ' [ ' . ucwords($tmp) . ' ] <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="' . route('cpanel.changepwd.index') . '"><span class="glyphicon glyphicon-lock"></span> Change Password</a></li>
                            </ul>
                        </li>';
//            }
            return $userInfo;
        }
    }

    protected function getBreadcrumb($var = true)
    {

        $tmp = array();
        $data = explode('.', \Route::currentRouteName());
        if (!isset($data[2])) {
            $data[2] = '';
        }
        switch ($data[2]) {
            case '':
                $tmp = array($data[1]);
                break;
            case 'home':
                $tmp = array('package', $data[2]);
                break;
            case 'report':
                $tmp = array('package', 'home', $data[1]);
                break;
            case 'backup':
                $tmp = array('package', 'home', $data[2]);
                break;
            case 'restore':
                $tmp = array('package', 'home', $data[2]);
                break;
            case 'index':
                if ($data[1] == 'disburse_client') {
                    $tmp = array('package', 'home', 'disburse', $data[1]);
                } else {
                    $tmp = array('package', 'home', $data[1]);
                }
                break;
            default:
                if ($data[1] == 'disburse_client') {
                    $tmp = array('package', 'home', 'disburse', $data[1], $data[2]);
                } else {
                    $tmp = array('package', 'home', $data[1], $data[2]);
                }
                break;
        }

        $count = count($tmp);
        $i = 1;
        $bread = '';

        foreach ($tmp as $key => $val) {
            if (in_array($val, array('create', 'add', 'edit', 'show', 'package', 'login', 'home', 'changepwd'))) {
                $curURL = Config::get('battambang/cpanel::breadcrumb.' . $val . '.url');
                $curLabel = Config::get('battambang/cpanel::breadcrumb.' . $val . '.label');
                $curIcon = Config::get('battambang/cpanel::breadcrumb.' . $val . '.icon');
            } else {
                $curURL = $this->getConfigByPackage('breadcrumb.' . $val . '.url');
                $curLabel = $this->getConfigByPackage('breadcrumb.' . $val . '.label');
                $curIcon = $this->getConfigByPackage('breadcrumb.' . $val . '.icon');
            }
            if ($i != $count) {
                $bread .= '<li><a href="' . $curURL . '"><i class="' . $curIcon . '"></i> ' . $curLabel . '</a></li>';
            } else {
                $bread .= '<li class="active"><i class="' . $curIcon . '"></i> ' . $curLabel . ' </li> ';

            }
            $i++;
        }

        if ($var == false) {
            return $header = array($curLabel, $curIcon);
        }
        return $bread;
    }

    protected function getHeader()
    {
//        if (\Auth::check()) {
        if (1) {
            $head = $this->getBreadcrumb(false);
            return '<h2><i class="' . $head[1] . '"></i> ' . $head[0] . '</h2>';
        }
    }

    protected function getHeaderInfo()
    {
        $tmp = '';
        if (UserSession::read()->package) {
            $head = $this->getBreadcrumb(false);
            if (in_array($head[0], array('Add New', 'Edit'))) {
                $tmp = '<label>items mark with <sup>*</sup> are required.</label>';
            }
        }

        return $tmp;
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