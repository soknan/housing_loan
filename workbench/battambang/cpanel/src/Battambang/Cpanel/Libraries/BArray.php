<?php
/**
 * Created by PhpStorm.
 * User: Theara-CBIRD
 * Date: 4/28/14
 * Time: 11:01 AM
 */

namespace Battambang\Cpanel\Libraries;


class BArray
{
    public function groupBy(
        $array = array(),
        $whereFields = array(),
        $sumFields = array(),
        $countFields = array()
    ) {

        $arrOnly = array();
        foreach ($array as $list) {
            $arrOnly[] = array_only($list, $whereFields);
        }

        $arrUnique = array_map("unserialize", array_unique(array_map("serialize", $arrOnly)));

        $result = array();
        foreach ($arrUnique as $list) {
            $where = array_where(
                $array,
                function ($key, $value) use ($list, $whereFields, $countFields) {

                    foreach ($whereFields as $whereFieldKey => $whereFieldValue) {
                        if ($whereFieldKey == 0) {
                            $compare = ($value[$whereFieldValue] == $list[$whereFieldValue]);
                        } else {
                            $compare = ($compare and ($value[$whereFieldValue] == $list[$whereFieldValue]));
                        }
                    }
                    return ($compare);
                }
            );

            $resultTem = array();
            foreach ($whereFields as $value) {
                $resultTem[$value] = $list[$value];
            }
            foreach ($sumFields as $value) {
                $resultTem[$value] = array_sum(array_fetch($where, $value));
            }
            foreach ($countFields as $countFieldValue) {
                $resultTem[$countFieldValue] = count(
                    array_where(
                        $where,
                        function ($key, $value) use ($countFieldValue) {
                            $exp = explode('.', $countFieldValue);
                            return ($value[$exp[0]] == $exp[1]);
                        }
                    )
                );
            }
            $resultTem['__count'] = count($where);
            $result[] = $resultTem;
        }

        return $result;
    }
} 