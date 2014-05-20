<?php namespace Battambang\Loan\Services\Validators\Disburse;

use Battambang\Cpanel\Services\Validators\ValidatorService;

class Validator extends ValidatorService
{
    public static $rules = array(
        'ln_center_id' => 'required',
        /*'ln_lv_meeting_schedule' => 'required',
        'ln_staff_id' => 'required',
        'ln_product_id'=> 'required',
        'disburse_date' => 'required',
        'ln_lv_account_type' => 'required',
        'cp_currency_id' => 'required',
        'num_installment' => 'required',
        'installment_frequency' => 'required',
        'num_payment' => 'required',
        'installment_principal_frequency' => 'required',
        'installment_principal_percentage' => 'required',
        'interest_rate' => 'required',
        'ln_fund_id' => 'required',*/
         );
}

