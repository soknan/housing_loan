<?php namespace Battambang\Loan\Services\Validators\Penalty;

use Battambang\Cpanel\Services\Validators\ValidatorService;

class Validator extends ValidatorService
{
    public function __construct(){
        parent::__construct($data=null);
        static::$rules = array(
            'name'=>'required|unique:ln_penalty,name,"'.\Request::segment(4).'"',
        );
    }


}
