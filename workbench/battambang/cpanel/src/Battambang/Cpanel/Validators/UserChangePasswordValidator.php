<?php
namespace Battambang\Cpanel\Validators;


use Battambang\Cpanel\User;

class UserChangePasswordValidator extends \ValidatorAssistant
{
    protected function before()
    {
        \Rule::add('old_password')
            ->required()
            ->oldPassword()->message('The old password is not a valid.');
        \Rule::add('password')->required()->alphaNum()->digitsBetween(6, 15)->confirmed()
            ->sameOldPassword()->message('The new password is same old password.')
            ->historyPassword()->message('The new password is same history password.');
        \Rule::add('password_confirmation')->required()->alphaNum()->digitsBetween(6, 15)
            ->sameOldPassword()->message('The new password is same old password.')
            ->historyPassword()->message('The new password is same history password.');

        $this->rules = \Rule::get();
        $this->messages = \Rule::getMessages();
    }

    // Custom Rule
    protected function customOldPassword($attribute, $value, $parameters)
    {
        $user = User::find(\Auth::user()->id);
        if (\Hash::check($value, $user->password)) {
            return true;
        }
        return false;
    }

    protected function customHistoryPassword($attribute, $value, $parameters)
    {
        $user = User::find(\Auth::user()->id);
        $history = json_decode($user->password_his_arr, true);

        foreach ($history as $historyValue) {
            if (\Hash::check($value, $historyValue)) {
                return false;
            }
        }
        return true;
    }

    protected function customSameOldPassword($attribute, $value, $parameters)
    {
        if ($value == $this->inputs['old_password']) {
            return false;
        }
        return true;
    }
}