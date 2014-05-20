<?php namespace Battambang\Loan\Services\Validators\WriteOff;

use Battambang\Cpanel\Services\Validators\ValidatorService;

class Validator extends ValidatorService
{
    public function __construct()
    {
        parent::__construct($data = null);

        static::$rules = array(
            'ln_disburse_client_id' => 'required' ,
            //'writeoff_date' => 'required|chk_writeoff_date' ,

        );
        static::$messages = array(
            'chk_writeoff_date'=>'Please do not choose future date!'
        );
    }
}

\Validator::extend('chk_writeoff_date', function ($attribute, $value, $parameters){
    if(new \DateTime($value) > new \DateTime()){
        return false;
    }
    return true;
});
