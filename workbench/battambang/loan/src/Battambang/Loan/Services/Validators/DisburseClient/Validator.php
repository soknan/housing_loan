<?php namespace Battambang\Loan\Services\Validators\DisburseClient;

use Battambang\Cpanel\Services\Validators\ValidatorService;

class Validator extends ValidatorService
{
    /*public static $rules = array(
        'ln_disburse_id' => 'required',
        'ln_lv_id_type'  => 'required',
        'id_num'  => 'required|chk_id_num',
        'expire_date'  => 'required|chk_expire_date',
        'amount'  => 'required',
        'voucher_id'  => 'required',
        /*'cycle'  => 'required',
        'ln_lv_history'  => 'required',
        'ln_lv_purpose'  => 'required',
        'ln_lv_activity'  => 'required',
        'ln_lv_collateral_type'  => 'required',
        'collateral_des'  => 'required',
        'ln_lv_security'  => 'required',
        'ln_client_id'  => 'required',

         'ln_lv_marital_status'  => 'required',
        'family_member'  => 'required',
        'num_dependent'  => 'required',
        'ln_lv_education' => 'required',
        'ln_lv_business'  => 'required',
        'ln_lv_poverty_status'  => 'required',
        'income_amount'  => 'required',
        'n_lv_handicap'  => 'required',
        'address'  => 'required',
        'ln_lv_contact_type'  => 'required',
        'contact_num'  => 'required',*/
        /*'email'  => 'required|email',
         );
    public static  $messages =array(
        'chk_expire_date'=>'expired',
        'chk_id_num'=>'You must have 9 digit',
    );*/

    public function __construct()
    {
        parent::__construct($data = null);

        static::$rules = array(
            'ln_disburse_id' => 'required',
            'ln_lv_id_type'  => 'required',
            'id_num'  => 'required_if:ln_lv_id_type,58|chk_id_num',
            'expire_date'  => 'required_if:ln_lv_id_type,58',
//            'expire_date'  => 'chk_expire_date|required_if:ln_lv_id_type,58',
            'amount'  => 'required',
            'voucher_id'  => 'required|chk_voucher:'.\UserSession::read()->sub_branch
                . '-' . date('Y') . '-' . \Input::get('currency_id'). '-' . sprintf('%06d', \Input::get('voucher_id')),
            'ln_lv_history'  => 'required',
            'ln_lv_purpose'  => 'required',
        );

        static::$messages = array(
            'chk_voucher'=>'Duplicated Voucher ID',
            'chk_expire_date'=>'expired',
            'chk_id_num'=>'You must have 9 digit in number only',
            'id_num.required_if'=>'The id number field is required when ID Type is National ID.',
            'expire_date.required_if'=>'The expire date field is required when ID Type is National ID.',
        );
    }
}

\Validator::extend('chk_expire_date', function ($attribute, $value, $parameters){
    $idType = \Input::get('ln_lv_id_type');
    if($idType !=59 or $idType!=63 or $idType!=66){
        if(date('Y-m-d',strtotime($value)) <= date('Y-m-d')){
            return false;
        }
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

\Validator::extend('chk_voucher', function ($attribute, $value, $parameters){
    $curRoute= explode('.',\Route::currentRouteName());

    $curVoucher = \UserSession::read()->sub_branch
        . '-' . date('Y') . '-' . \Input::get('currency_id'). '-' . sprintf('%06d', \Input::get('voucher_id'));
    if(\Input::has('hidden_voucher_id')){
        $upVoucher = \UserSession::read()->sub_branch
            . '-' . date('Y') . '-' . \Input::get('currency_id'). '-' . sprintf('%06d', \Input::get('hidden_voucher_id'));
    }

    if($curRoute[2] == 'update'){
        $voucher = \DB::table('ln_disburse_client')->where('voucher_id','!=',$upVoucher)->get();
    }else{
        $voucher = \DB::table('ln_disburse_client')->get();
    }

    foreach ($voucher as $row) {
        if($curVoucher == $row->voucher_id){
            return false;
        }
    }
    return true;
});

