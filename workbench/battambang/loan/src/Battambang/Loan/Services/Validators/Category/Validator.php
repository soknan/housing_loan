<?php namespace Battambang\Loan\Services\Validators\Category;

use Battambang\Cpanel\Libraries\Rule;
use Battambang\Cpanel\Services\Validators\ValidatorService;

class Validator extends ValidatorService
{
    public function __construct()
    {
        parent::__construct($data = null);

        static::$rules = array(
            'name' => 'required|unique:ln_category,name,"'.\Request::segment(4).'"' ,
            'des' => 'required',
        );
    }

}
