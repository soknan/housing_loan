<?php
/**
 * Created by PhpStorm.
 * User: Theara-CBIRD
 * Date: 4/7/14
 * Time: 3:44 PM
 */

namespace Battambang\Cpanel\Libraries;


class Select2
{
    public function make($selectorId, $url, $minimumInputLength = 2, $placeholder = 'Please search...', $allowClear = true)
    {
        return '<script>
        $("#' . $selectorId . '").select2({
            placeholder: "' . $placeholder . '",
            allowClear: ' . $allowClear . ',
            minimumInputLength: ' . $minimumInputLength . ',
            ajax: {
                dataType: "json",
                url: "' . $url . '",
                data: function (term, page) {
                    return {
                        ' . $selectorId . ': term
                    };
                },
                results: function (data) {
                    return {
                        results: data
                    };
                },
            },
            initSelection: function (element, callback) {
                //sets a default value (if a value was selected previously)

                //get the existing value
                var id = $(element).val();

                //if a value was selected: perform an Ajax call to retrieve the text label
                if (id !== "") {
                    $.ajax("' . $url . '", {
                        data: { id: id },
                        dataType: "json"
                    }).done(function (data) { callback(data); });
                }
            }
        });
        </script>';
    }
} 