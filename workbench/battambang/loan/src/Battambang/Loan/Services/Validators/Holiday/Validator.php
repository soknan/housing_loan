<?php namespace Battambang\Loan\Services\Validators\Holiday;

use Battambang\Cpanel\Services\Validators\ValidatorService;

class Validator extends ValidatorService
{
    public static $rules = array(
        'name'=>'required',
         );

}
