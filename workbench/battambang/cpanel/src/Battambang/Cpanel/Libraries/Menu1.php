<?php
/**
 * Created by JetBrains PhpStorm.
 * User: SOKNAN
 * Date: 10/9/13
 * Time: 10:31 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Battambang\Cpanel\Libraries;

use HTML;

class Menu1
{
    //Main Menu
    public function make($menu)
    {
        if (!is_array($menu)) {
            (array)$menu;
        }
        $tmp = '';
        $st = '';
        foreach ($menu as $title => $args) {

            if ($args['type'] == 'single') {
                $tmp .= '<li>' . HTML::link($args['url'], $title) . '</li>';
//                $tmp.='<li><a href="'.$args['url'].'"><i class="glyphicon glyphicon-home"></i> '.$title.'</a></li>';

            } else {
                $st .= '<li class="dropdown">';
                $st .= '<a data-toggle="dropdown" class="dropdown-toggle" href="#">' .
                    $title . '<b class="caret"></b>
                </a>
                <ul class="dropdown-menu">';
                $st .= $this->_subMenu($args['links']);
                $st .= '</ul></li>';
            }
        }
        return $tmp . $st;
    }

    //subMenu
    protected function _subMenu($subMenu)
    {
        $tmp = '';
        $sub = '';
        foreach ($subMenu as $title => $value) {
            if ($value['type'] == 'single') {
                //$tmp.= '<li>'.HTML::link($value['url'], $title).'</li>';
                $tmp .= '<li><a href="' . $value['url'] . '">' . $title . '</a></li>';
            } else {
                $sub .= '<li class="dropdown-submenu">';
                $sub .= '<a tabindex="-1" href="#">' . $title . '</a>';
                $sub .= '<ul class="dropdown-menu">';
                $sub .= $this->_subMenu($value['links']);
                $sub .= '</ul></li>';
            }
        }
        return $tmp . $sub;
    }

}

