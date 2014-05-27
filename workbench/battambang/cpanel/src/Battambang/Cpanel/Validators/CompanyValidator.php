<?php
namespace Battambang\Cpanel\Validators;


class CompanyValidator extends \ValidatorAssistant
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
        \Rule::add('logo')->chkLogo()->message('The :attribute must be an image (.png, .jpg).');

        if (!empty($this->inputs['register_at'])) {
            $this->inputs['register_at'] = date('Y-m-d', strtotime($this->inputs['register_at']));
        }
        $this->rules = \Rule::get();
        $this->messages = \Rule::getMessages();
    }

    protected function customChkLogo($attribute, $value, $parameters)
    {
        $ext = \Input::file('logo')->getClientOriginalExtension();
        $size = \Input::file('logo')->getClientSize();
        if (!empty($value) and !in_array($ext, array('png', 'jpg'))) {
            return false;
        }
        return true;
    }
}