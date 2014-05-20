<?php
namespace Battambang\Cpanel\Validators;


class LoginValidator extends \ValidatorAssistant
{
    protected function before()
    {
        \Rule::add('username')->required();
        \Rule::add('password')->required();

        $this->rules = \Rule::get();
    }
}