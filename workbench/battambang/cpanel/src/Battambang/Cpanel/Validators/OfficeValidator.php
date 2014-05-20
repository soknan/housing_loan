<?php
namespace Battambang\Cpanel\Validators;


class OfficeValidator extends \ValidatorAssistant
{

    protected function before()
    {
        \Rule::add('kh_name')->required();
        \Rule::add('kh_short_name')->required();
        \Rule::add('en_name')->required();
        \Rule::add('en_short_name')->required();
        \Rule::add('register_at')->required();
        \Rule::add('kh_address')->required();
        \Rule::add('en_address')->required();
        \Rule::add('telephone')->required();

        $this->inputs['register_at'] = date('Y-m-d', strtotime($this->inputs['register_at']));
        $this->rules = \Rule::get();
    }
}