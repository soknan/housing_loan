<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 10/21/13
 * Time: 1:42 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Battambang\Cpanel\Libraries;


class Format
{
    public function dateFormatSave($date)
    {
        $tmp='';
        if ($date === FALSE) {
            $currentdate = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            $tmp = date('Y-m-d', $currentdate);
        } elseif ($date == "") {
            $tmp = NULL;
        } else {
            $dt_arr = date_parse_from_format('d-m-Y', $date);
            $dt = mktime(0, 0, 0, $dt_arr['month'], $dt_arr['day'], $dt_arr['year']);
            $tmp = date('Y-m-d', $dt);
        }
        return $tmp;
    }

    public function dateFormatForm($date)
    {

        if ($date == NULL) {
            return "";
        }
        return date('d-m-Y', strtotime($date));
    }

    public function dateFormatList($date)
    {
        if ($date == NULL) {
            return "";
        }
        return date("d-M-Y", strtotime($date));
    }

    public function dateTimeFormatList($date)
    {
        if ($date == NULL) {
            return "";
        }
        return date("d-M-Y", strtotime($date));
    }

    public function trimUnicode($str)
    {
        return trim(str_replace("\xE2\x80\x8B", "", $str));
    }

    public function numberFormatSave($str)
    {
        return str_replace(",", "", $str);
    }
}