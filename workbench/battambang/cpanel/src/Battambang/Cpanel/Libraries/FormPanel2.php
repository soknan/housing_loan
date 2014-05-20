<?php
/**
 * Created by PhpStorm.
 * User: Theara-CBIRD
 * Date: 2/4/14
 * Time: 1:52 PM
 */

namespace Battambang\Cpanel\Libraries;


use Battambang\Cpanel\Facades\Column;

class FormPanel2
{

    public function make($title, $column1 = array(), $column2 = array(), $state = 'default')
    {
        $panel = '<div class="panel panel-' . $state . '">
            <div class="panel-heading">' . $title . '</div>
            <div class="panel-body">
            <div class="row">
            <div class="col-md-6">'
            . (is_array($column1) ? implode('', $column1) : $column1)
            . '</div>
            <div class="col-md-6">'
            . (is_array($column2) ? implode('', $column2) : $column2)
            . '</div>
            </div>
            </div>
            </div>';
        return $panel;
    }
} 