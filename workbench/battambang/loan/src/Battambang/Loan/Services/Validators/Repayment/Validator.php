<?php namespace Battambang\Loan\Services\Validators\Repayment;

use Battambang\Cpanel\Libraries\Rule;
use Battambang\Cpanel\Services\Validators\ValidatorService;

class Validator extends ValidatorService
{
    public function __construct()
    {
        parent::__construct($data = null);

        static::$rules = array(
            //'repayment_date' => 'required|chk_repay_date' ,

        );
        static::$messages = array(
            'chk_repay_date'=>'Please do not choose future date!'
        );
    }

}

\Validator::extend('chk_repay_date', function ($attribute, $value, $parameters){
    if(new \DateTime($value) > new \DateTime()){
        return false;
    }
    return true;
});
