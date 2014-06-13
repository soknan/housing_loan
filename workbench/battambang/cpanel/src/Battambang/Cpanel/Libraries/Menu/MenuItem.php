<?php
/**
 * Created by PhpStorm.
 * User: Theara-CBIRD
 * Date: 6/4/14
 * Time: 10:02 AM
 */

namespace Battambang\Cpanel\Libraries\Menu;

use Battambang\Cpanel\Libraries\Menu\Template\Bootstrap3;

class MenuItem
{
    protected $menu = array();
    private static $_filters = array();
    protected $tmp;

    public function __construct()
    {
        $this->tmp = new Bootstrap3();
    }

    public function filter($items)
    {
        if (!is_array($items)) {
            $items = array($items);
        }
        static::$_filters = $items;
    }

    public function add($title, $callback, $icon = null)
    {
        if (is_callable($callback)) {
            $builder = new MenuSubItem(static::$_filters);
            $callback($builder);
            $this->menu[] = $this->tmp->dropdown($title, $builder->get(), $icon);
        } else {
            $this->menu[] = $this->tmp->link($title, $callback, $icon, static::$_filters);
        }
    }

    public function get()
    {
        return PHP_EOL . implode(PHP_EOL, $this->menu) . PHP_EOL;
    }
} 