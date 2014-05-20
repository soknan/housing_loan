<?php
namespace Battambang\Cpanel\Validators;


class PermissionValidator extends \ValidatorAssistant
{
    protected function before()
    {
        \Rule::add('per_date')->required();
        \Rule::add('user_code')->required();
        \Rule::add('db_type')->required();
        \Rule::add('office_code')->required();
        \Rule::add('permissions')->required();

        $this->rules = \Rule::get();
    }
}