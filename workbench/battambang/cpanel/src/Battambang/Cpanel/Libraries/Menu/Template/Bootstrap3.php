<?php
/**
 * Created by PhpStorm.
 * User: Theara-CBIRD
 * Date: 6/4/14
 * Time: 1:08 PM
 */

namespace Battambang\Cpanel\Libraries\Menu\Template;


class Bootstrap3
{
    public function menu($menu)
    {
        $tmp = '<ul class="nav navbar-nav">'
            . implode(PHP_EOL, $menu)
            . '</ul>';

        return $tmp;
    }

    public function dropdown($title, $dropdown, $icon = null)
    {
        $icon = $this->getIcon($icon);
        $tmp = '<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $icon . $title . ' <b class="caret"></b></a>
                    <ul class="dropdown-menu">'
            . $dropdown
            . '</ul>
                </li>';

        return $tmp;
    }

    public function dropdownSubMenu($title, $dropdown, $icon = null)
    {
        $icon = $this->getIcon($icon);
        $tmp = '<li class="dropdown-submenu">
                    <a tabindex="-1" href="#">' . $icon . $title . '</a>
                    <ul class="dropdown-menu">'
            . $dropdown
            . '</ul>
                </li>';

        return $tmp;
    }

    public function link($title, $url, $icon = null)
    {
        // Check active link
        $active = '';
        if (\URL::current() == $url) {
            $active = ' class="active"';
        }
        $icon = $this->getIcon($icon);
        $tmp = '<li' . $active . '><a href="' . $url . '">' . $icon . $title . '</a></li>';

        return $tmp;
    }

    public function divider()
    {
        $tmp = '<li class="divider"></li>';

        return $tmp;
    }

    private function getIcon($name = null)
    {
        if (!is_null($name) or !empty($name)) {
            $icon = '<span class="glyphicon ' . $name . '"></span> ';
        } else {
            $icon = '';
        }
        return $icon;
    }
}