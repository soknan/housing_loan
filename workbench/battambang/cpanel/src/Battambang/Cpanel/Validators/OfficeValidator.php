<?php
namespace Battambang\Cpanel\Validators;


class OfficeValidator extends \ValidatorAssistant
{

    protected function before()
    {
        \Rule::add('kh_name')->required()->unique(
            'cp_office',
            'kh_name',
            \Request::segment(4)
        );
        \Rule::add('kh_short_name')->required()->unique(
            'cp_office',
            'kh_short_name',
            \Request::segment(4)
        );
        \Rule::add('en_name')->required()->unique(
            'cp_office',
            'en_name',
            \Request::segment(4)
        );
        \Rule::add('en_short_name')->required()->unique(
            'cp_office',
            'en_short_name',
            \Request::segment(4)
        );
        \Rule::add('register_at')->required();
        \Rule::add('kh_address')->required();
        \Rule::add('en_address')->required();
        \Rule::add('telephone')->required();

        $this->inputs['register_at'] = date('Y-m-d', strtotime($this->inputs['register_at']));
        $this->rules = \Rule::get();
    }
}