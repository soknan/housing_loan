<?php
namespace Battambang\Cpanel\Validators;


class WorkDayValidator extends \ValidatorAssistant
{
    protected function before()
    {
        \Rule::add('work_week')->required();
        \Rule::add('work_month')->required();
        \Rule::add('work_time')->required();
        \Rule::add('activated_at')->required();

        $this->inputs['activated_at'] = date('Y-m-d', strtotime($this->inputs['activated_at']));
        $this->rules = \Rule::get();
    }
}