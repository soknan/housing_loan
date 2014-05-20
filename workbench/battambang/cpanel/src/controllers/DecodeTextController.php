<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/20/13
 * Time: 8:47 AM
 */

namespace Battambang\Cpanel;
use Input,View,Config;

class DecodeTextController extends BaseController{

    public function index(){
        return $this->renderLayout(
            View::make(Config::get('battambang/cpanel::views.decode_text'))
        );
    }
} 