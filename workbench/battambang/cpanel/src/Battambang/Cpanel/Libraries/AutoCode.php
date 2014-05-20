<?php
/**
 * Created by JetBrains PhpStorm.
 * User: SOKNAN
 * Date: 9/19/13
 * Time: 3:36 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Battambang\Cpanel\Libraries;
use DB;

class AutoCode
{
    public function  make($table, $field, $prefix, $suffix_length){

        $gcode ="";
        $format = "%0".$suffix_length."d";
        //$find = "SELECT $field FROM $table WHERE $field LIKE '$prefix%' ORDER BY $field DESC ";

        $findresult	= DB::table($table)
            ->where($field,'like',"$prefix%")
            ->orderBy($field,"DESC")
            ->first();

        if($findresult!=null){
            $tmp_rec = (array)$findresult;

            $rec = $tmp_rec[$field];
            $tmp = substr($rec,strlen($prefix),$suffix_length);
            $tmp = intval($tmp);
            $tmp++;
            $gcode = $prefix.sprintf($format, $tmp);

        }else{
            $gcode = $prefix.sprintf($format, 1);
        }
        return $gcode;
    }
}