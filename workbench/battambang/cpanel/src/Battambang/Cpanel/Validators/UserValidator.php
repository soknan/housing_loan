<?php
namespace Battambang\Cpanel\Validators;


class UserValidator extends \ValidatorAssistant
{
    protected function before()
    {
        \Rule::add('first_name')->required();
        \Rule::add('last_name')->required();
        \Rule::add('email')->required()->email()->unique(
            'cp_user',
            'email',
            \Request::segment(4)
        );
        \Rule::add('username')->required()->alphaDash()->unique(
            'cp_user',
            'username',
            \Request::segment(4)
        );
        \Rule::add('password')->confirmed()
            ->alphaAndNum()->message('The field must be contain letters and numeric.');
        \Rule::add('password_confirmation')
            ->alphaAndNum()->message('The field must be contain letters and numeric.');
        \Rule::add('expire_day')->required();
        \Rule::add('activated')->required();
        \Rule::add('activated_at')->required();
        \Rule::add('group')->required();

        $this->inputs['activated_at'] = date('Y-m-d', strtotime($this->inputs['activated_at']));
        $this->rules = \Rule::get();
        $this->messages = \Rule::getMessages();
    }

    protected function customAlphaAndNum($attribute, $value, $parameters)
    {
        if (!preg_match('/[0-9]+/', $value)) {
            return false;
        }

        if (!preg_match('/[a-zA-Z]+/', $value)) {
            return false;
        }

        return true;
    }
}