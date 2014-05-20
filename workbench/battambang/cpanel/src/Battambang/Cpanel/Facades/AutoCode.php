<?php
/**
 * Created by JetBrains PhpStorm.
 * User: SOKNAN
 * Date: 9/19/13
 * Time: 2:03 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Battambang\Cpanel\Facades;
use Illuminate\Support\Facades\Facade;

class AutoCode extends Facade{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'autocode'; }

}