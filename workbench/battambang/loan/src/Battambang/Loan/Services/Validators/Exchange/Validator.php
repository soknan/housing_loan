<?php namespace Battambang\Loan\Services\Validators\Exchange;

use Battambang\Cpanel\Services\Validators\ValidatorService;

class Validator extends ValidatorService
{
    public function __construct()
    {
        $data = array(
            'exchange_at' => \Carbon::createFromFormat('d-m-Y', \Input::get('exchange_at'))->toDateString(),
            'khr_usd' => \Input::get('khr_usd'),
            'usd' => \Input::get('usd'),
            'khr_thb' => \Input::get('khr_thb'),
            'thb' => \Input::get('thb'),
            'des' => \Input::get('des'),

        );
        parent::__construct(
            $data = $data
        );
        static::$rules = array(
//            'exchange_at' => 'unique:ln_exchange,exchange_at',
            'exchange_at' => 'unique:ln_exchange,exchange_at,' . \Request::segment(4),
        );
    }
}