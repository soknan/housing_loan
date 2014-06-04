<?php
/**
 * Created by PhpStorm.
 * User: Theara-CBIRD
 * Date: 6/4/14
 * Time: 8:10 AM
 */

namespace Battambang\Cpanel\Libraries\Menu;

use Closure;
use Battambang\Cpanel\Libraries\Menu\Template\Bootstrap3;

class Menu
{
    protected $menu = array();
    protected $tmp;

    public function __construct()
    {
        $this->tmp = new Bootstrap3();
    }

    public function make($name, Closure $callback)
    {
        $builder = new MenuItem();
        $callback($builder);
        $this->menu[$name] = $builder->get();
    }

    public function get($names)
    {
        if (!is_array($names)) {
            $names = array($names);
        }
        $temList = array();
        foreach ($names as $list) {
            $temList[] = $this->menu[$list];
        }
        return $this->tmp->menu($temList);
    }
} 