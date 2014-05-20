<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 10/21/13
 * Time: 1:46 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Battambang\Cpanel\Libraries;
use Battambang\Cpanel\Libraries\Format;
use Former;

class Calendar
{
    public function make($data,$tittle, $value=null, $show_null = TRUE)
    {
        if($value==null) $value = date('Y-m-d');
        $format = new Format();
        $data = trim($data);
        $str = "";
        /*$arr = array(
            "name" => $data,
            "value" => $format->dateFormatForm($value),
            "id" => $data,
            "readonly" => "readonly"

        );*/
        if($show_null == TRUE){
            $str.= Former::row_col_md_12_text($data,$tittle,$format->dateFormatForm($value))
                ->required()
                ->append('<a id="cal'.$data.'"><i class="icon-calendar"></i></a>')
                ->setAttributes(array('readonly'=>'readonly','style'=>'width:100%'));
            /*$str.='<div class="row">
                      <div class="col-lg-12">
                        <div class="input-group">
                          <input type="text" class="form-control">
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="icon-calendar"></i></button>
                          </span>
                        </div>
                      </div>
                    </div>';*/
        }else{
            $str.= Former::col_md_12_text($data,$tittle,$format->dateFormatForm($value))
                ->setAttributes(array('readonly'=>'readonly','style'=>'width:100%'))
                ->append('<a id="cal'.$data.'" ><i class="icon-calendar"></i></a>',"<button class=\"btn btn-inverse\" name=\"cal_null_" . $data . "\" id=\"cal_null_" . $data . "\" onclick=\"document.getElementById('".$data."').value='';return false;\"><i class=\"icon-remove\"></i></button>");


        }

        /*$str .= "<input type='text' value='".$format->dateFormatForm($value)."' name='".$data."' id='".$data."' readonly = 'readonly' />";
        $str .= "
			<button class=\"cal_img\" id=\"cal" . $data . "\" name=\"cal" . $data . "\"></button>
			";
        if ($show_null == TRUE) {
            $str .= "
			<button class=\"cal_null\" name=\"cal_null_" . $data . "\" id=\"cal_null_" . $data . "\" onclick=\"document.getElementById('".$data."').value='';return false;\"></button>
		";
        }*/

        $str .= "
						<script type=\"text/javascript\">
						var CAL_" . $data . " = new Calendar({
	                        	inputField: \"" . $data . "\",
	                        	dateFormat: \"%d-%m-%Y\",
	                       		trigger: \"cal" . $data . "\",
	                  			bottomBar: false,
	                          	onSelect: function() {
		                         	var date = Calendar.intToDate(this.selection.get());
		                         	this.hide();

											$('[name=\"" . $data . "\"]').change();

	                          	}
                  			});

						</script>";
        return $str;
    }

}