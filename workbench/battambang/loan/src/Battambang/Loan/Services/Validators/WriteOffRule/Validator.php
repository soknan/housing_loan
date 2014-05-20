<?php namespace Battambang\Loan\Services\Validators\WriteOffRule;

use Battambang\Cpanel\Services\Validators\ValidatorService;

class Validator extends ValidatorService
{
    public static $rules = array(
        'num_day'=>'required',
         );

}
