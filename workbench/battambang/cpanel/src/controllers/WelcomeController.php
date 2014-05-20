<?php
namespace Battambang\Cpanel;

use View;
use UserSession;

class WelcomeController extends BaseController
{

    public function getIndex()
    {
        $arr = array();
        $arr['data'] = UserSession::read();
        return $this->renderLayout(View::make(\Config::get('battambang/cpanel::views.welcome'), $arr));
    }

}