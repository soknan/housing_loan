<?php namespace Battambang\Loan\Services\Validators\Product;

use Battambang\Cpanel\Services\Validators\ValidatorService;
use Former\Form\Fields\Input;

class Validator extends ValidatorService
{
    public function __construct(){
        parent::__construct($data = null);
        static::$rules= array(
            'ln_category_id' => 'required',
            'name' => 'required|unique:ln_product,name,"'.\Request::segment(4).'"',
            'start_date' => 'required',
            'end_date' => 'required|chk_end_date',
            'ln_lv_account_type_arr' => 'required',
            'cp_currency_id_arr'=> 'required',
            'ln_lv_repay_frequency' => 'required',
            'min_installment' => 'required|chk_min_ins',
            'max_installment' => 'required',
            'default_installment' => 'required|chk_default_ins',
            'ln_lv_holiday_rule' => 'required',
            'ln_lv_interest_type' => 'required',
            'min_interest' => 'required|chk_min_int',
            'max_interest' => 'required',
            'default_interest' => 'required|chk_default_int',
            'ln_lv_loan_amount_type' => 'required',
            'min_amount'=> 'required|chk_min_amount',
            'max_amount'=> 'required',
            'default_amount'=> 'required|chk_default_amount',
            'ln_fee_id'=> 'required',
            'ln_penalty_id'=> 'required',
            'ln_penalty_closing_id'=> 'required',
            'ln_fund_id_arr'=> 'required',

        );

        static::$messages = array(
            'chk_min_amount' => 'Min Amount can not bigger than Max Amount.',
            'chk_default_amount' => 'Default Amount Error.',

            'chk_min_ins' => 'Min installment can not bigger than Max installment.',
            'chk_default_ins' => 'Default can not bigger than Max installment.',

            'chk_min_int' => 'Min interest can not bigger than Max interest.',
            'chk_default_int' => 'Default can not bigger than Max interest.',

            'chk_end_date' => 'Start Date can not bigger than End Date.'
        );
    }


}

\Validator::extend('chk_min_ins', function ($attribute, $value, $parameters){
    $max_ins = \Input::get('max_installment');
    if($value > $max_ins ){
        return false;
    }
    return true;
});

\Validator::extend('chk_default_ins', function ($attribute, $value, $parameters){
    $min_ins = \Input::get('min_installment');
    $max_ins = \Input::get('max_installment');
    if($value > $max_ins or $value < $min_ins ){
        return false;
    }
    return true;
});

\Validator::extend('chk_min_int', function ($attribute, $value, $parameters){
    $max_int = \Input::get('max_interest');
    if($value > $max_int ){
        return false;
    }
    return true;
});

\Validator::extend('chk_default_int', function ($attribute, $value, $parameters){
    $min_int = \Input::get('min_interest');
    $max_int = \Input::get('max_interest');
    if($value > $max_int or $value < $min_int ){
        return false;
    }
    return true;
});

\Validator::extend('chk_min_amount', function ($attribute, $value, $parameters){
    $max_amount = \Input::get('max_amount');
    if($value > $max_amount ){
        return false;
    }
    return true;
});

\Validator::extend('chk_default_amount', function ($attribute, $value, $parameters){
    $min_amount = \Input::get('min_amount');
    $max_amount = \Input::get('max_amount');
    if($value > $max_amount or $value < $min_amount ){
        return false;
    }
    return true;
});

\Validator::extend('chk_end_date', function ($attribute, $value, $parameters){
    $start_date = \Input::get('start_date');
    if(new \DateTime($start_date) > new \DateTime($value) ){
        return false;
    }
    return true;
});
