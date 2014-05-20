<?php
namespace Battambang\Cpanel\Validators;


class UserValidator extends \ValidatorAssistant
{
    protected function before()
    {
        \Rule::add('first_name')->required();
        \Rule::add('last_name')->required();
        \Rule::add('email')->required()->email()->unique('cp_user', 'email', $this->inputs['hidden_id']);
        \Rule::add('username')->required()->alphaDash()->digitsBetween(1, 30)->unique('cp_user', 'username', $this->inputs['hidden_id']);
        \Rule::add('password')->required()->alphaNum()->digitsBetween(6, 15)->confirmed()
        ->alphaAndNum()->message('The :attribute must be contain letters and numeric.');
        \Rule::add('password_confirmation')->required()->alphaNum()->digitsBetween(6, 15)
        ->alphaAndNum()->message('The :attribute must be contain letters and numeric.');
        \Rule::add('activated')->required();
        \Rule::add('expire_day')->required();
        \Rule::add('activated_at')->required();
        \Rule::add('cp_group_id')->required();

        $this->inputs['activated_at'] = date('Y-m-d', strtotime($this->inputs['activated_at']));
        $this->rules = \Rule::get();
    }

    protected function customAlphaAndNum($attribute, $value, $parameters){
        return true;
    }
}