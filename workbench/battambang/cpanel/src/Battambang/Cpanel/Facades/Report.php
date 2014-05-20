<?php
/**
 * Created by JetBrains PhpStorm.
 * User: SOKNAN
 * Date: 10/11/13
 * Time: 11:02 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Battambang\Cpanel\Facades;


use Illuminate\Support\Facades\Facade;

class Report extends Facade{
    protected static function getFacadeAccessor() { return 'report'; }
}