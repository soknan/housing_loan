<?php
namespace Battambang\Cpanel\Validators;


class GroupValidator extends \ValidatorAssistant
{
    protected function before()
    {
        \Rule::add('group_name')->required()->unique('cp_group', 'name', \Request::segment(4));
        \Rule::add('branch_office')->required();
        \Rule::add('package')->required();
        \Rule::add('permission')->required();

        $this->rules = \Rule::get();
    }
}