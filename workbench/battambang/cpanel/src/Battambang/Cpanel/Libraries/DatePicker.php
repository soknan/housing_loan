<?php
/**
 * Created by PhpStorm.
 * User: Theara-CBIRD
 * Date: 4/7/14
 * Time: 3:44 PM
 */

namespace Battambang\Cpanel\Libraries;


class DatePicker
{
    public function make($selectorId, $startDate = '', $endDate = '', $format = 'dd-mm-yyyy', $options = array())
    {
        $optionsTem = '';
        foreach ($options as $key => $val) {
            $optionsTem .= $key . ': "' . $val . '"';
        }
        return '<script>
        $("#' . $selectorId . '").datepicker({
            format: "' . $format . '",
            autoclose: true,
            todayBtn: "linked",
            todayHighlight: true,
            clearBtn: true,
            startDate: "' . $startDate . '",
            endDate: "' . $endDate . '",
            ' . $optionsTem . '
        });
        </script>';
    }
} 