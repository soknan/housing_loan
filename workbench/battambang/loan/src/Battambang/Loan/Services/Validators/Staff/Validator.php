<?php namespace Battambang\Loan\Services\Validators\Staff;

use Battambang\Cpanel\Services\Validators\ValidatorService;

class Validator extends ValidatorService
{
    public static  $rules = array(
        'en_first_name' => 'required',
        'en_last_name' => 'required',
        'kh_first_name' => 'required',
        'kh_last_name' => 'required',
        'ln_lv_gender' => 'required',
        'dob'=>'required|chk_dob',
        'ln_lv_marital_status' => 'required',
        'ln_lv_education' => 'required',

        'ln_lv_id_type' => 'required',
        'id_num' => 'required_if:ln_lv_id_type,58|chk_id_num',
        'expire_date' => 'required_if:ln_lv_id_type,58',
        'ln_lv_title' => 'required',
        'joining_date' => 'required',
        'telephone' => 'required',
        'attach_photo' => 'chk_attach_photo'
         );

    public static  $messages = array(
        'chk_dob' => 'You are so young',
        'chk_id_num' => 'you must to type 9 digits',
        'chk_expire_date' => 'Your Id has been expired ',
        'chk_attach_photo'=>'Your files extension must be png or jpg.',
        'id_num.required_if'=>'The id number field is required when ID Type is National ID.',
        'expire_date.required_if'=>'The expire date field is required when ID Type is National ID.',
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

\Validator::extend('chk_expire_date', function ($attribute, $value, $parameters){
    //if($value=='00-00-0000') return false;
    if(new \DateTime() > new \DateTime($value)){
        return false;
    }
    return true;
});

\Validator::extend('chk_id_num', function ($attribute, $value, $parameters){
    $id_type = \Input::get('ln_lv_id_type');
    if($id_type == 58 and (strlen($value)!=9 or !is_numeric($value))){
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

