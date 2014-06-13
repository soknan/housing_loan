<?php
/**
 * Created by PhpStorm.
 * User: Theara-CBIRD
 * Date: 6/4/14
 * Time: 10:02 AM
 */

namespace Battambang\Cpanel\Libraries\Menu;

use Battambang\Cpanel\Libraries\Menu\Template\Bootstrap3;

class MenuSubItem
{
    protected $menu = array();
    private static $_filters;
    protected $tmp;

    public function __construct($filter = null)
    {
        static::$_filters = $filter;
        $this->tmp = new Bootstrap3();
    }

    public function add($title, $callback, $icon = null)
    {
        if (is_callable($callback)) {
            $builder = new self(static::$_filters);
            $callback($builder);
            $this->menu[] = $this->tmp->dropdownSubMenu($title, $builder->get(), $icon);
        } else {
            $this->menu[] = $this->tmp->link($title, $callback, $icon, static::$_filters);
        }
    }

    public function divider()
    {
        $this->menu[] = $this->tmp->divider();
    }

    public function get()
    {
        return implode(PHP_EOL, $this->menu);
    }
} 