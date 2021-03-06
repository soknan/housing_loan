<?php
namespace Battambang\Cpanel\Validators;


class DistrictValidator extends \ValidatorAssistant
{
    protected function before()
    {
        \Rule::add('id')->required()->unique(
            'cp_location',
            'id',
            \Request::segment(4)
        );
        \Rule::add('kh_name')->required();
        \Rule::add('en_name')->required();

        $this->rules = \Rule::get();
    }
}