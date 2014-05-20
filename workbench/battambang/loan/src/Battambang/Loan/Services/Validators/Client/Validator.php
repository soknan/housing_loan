<?php namespace Battambang\Loan\Services\Validators\Client;

use Battambang\Cpanel\Services\Validators\ValidatorService;

class Validator extends ValidatorService
{
    public static $rules = array(
        'en_first_name' => 'required',
         'en_last_name' => 'required',

         'kh_first_name' => 'required',
         'kh_last_name' => 'required',

         'ln_lv_gender' => 'required',
         'dob'=>'required|chk_dob',
         /*'place_birth' => 'required',*/
         'ln_lv_nationality' => 'required',
         'attach_photo'=>'chk_attach_photo',

    );

    public static $messages = array(
        'chk_dob'=>'Your dob must high than 16.',
        'chk_attach_photo'=>'Your files extension must be png or jpg.'
    );


}

\Validator::extend('chk_attach_photo', function ($attribute, $value, $parameters) {
    $ext = \Input::file('attach_photo')->getClientOriginalExtension();
    $size = \Input::file('attach_photo')->getClientSize();
    if (!empty($value) and !in_array($ext, array('png', 'jpg'))) {
        return false;
    }
    return true;
});

\Validator::extend('chk_dob', function ($attribute, $value, $parameters){
    $age = age($value);
    if($age < 17 ){
        return false;
    }
    return true;
});

function age($date){
    $year_diff = '';
    $time = strtotime($date);

    if(FALSE === $time){
        return '';
    }

    $date = date('Y-m-d', $time);
    list($year,$month,$day) = explode("-",$date);
    $year_diff = date("Y") - $year;
	$month_diff = date("m") - $month;
	$day_diff = date("d") - $day;
	if ($day_diff < 0 or $month_diff < 0) $year_diff -- ;

	return $year_diff;
}


