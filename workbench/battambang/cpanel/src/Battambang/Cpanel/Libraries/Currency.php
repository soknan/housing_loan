<?php
/**
 * Created by PhpStorm.
 * User: Theara-CBIRD
 * Date: 2/5/14
 * Time: 2:42 PM
 */

namespace Battambang\Cpanel\Libraries;


use Battambang\Loan\Exchange;

class Currency
{
    private $khrUSD = 4000;
    private $usd = 1;
    private $khrTHB = 100;
    private $thb = 1;

    /**
     * @param $currencyID
     * @param $amount
     * @return float
     */
    public function round($currencyID, $amount)
    {
        switch ($currencyID) {
            case 1: // KHR
            case 'KHR':
                $rounding = 100;
                $amount = round($amount / $rounding) * $rounding;
                break;
            case 2: // USD
            case 'USD':
                $rounding = 2;
                $amount = round($amount, $rounding);
                break;
            case 3 || 'THB': // THB
            case 'THB':
                $rounding = 0;
                $amount = round($amount, $rounding);
                break;
        }
        return $amount;
    }

    public function format($currencyID, $amount)
    {
        $code = \Battambang\Cpanel\Currency::find($currencyID)->code;
        $decPoint = explode('.', $amount);
        $decDigit = (isset($decPoint[1]) ? strlen($decPoint[1]) : 0);
        $amount = number_format($amount, $decDigit) . ' ' . $code;
        return $amount;
    }

    /**
     * @param $currencyID
     * @param $amount
     * @param null $exchangeID
     * @param bool $round
     * @return float
     */
    public function toKHR($currencyID, $amount, $exchangeID = null, $round = false, $format = false)
    {
        $this->_setExchange($exchangeID);
        switch ($currencyID) {
            case 1:
                $amount = $amount;
                break;
            case 2:
                $amount = ($amount * $this->khrUSD) / $this->usd;
                break;
            case 3:
                $amount = ($amount * $this->khrTHB) / $this->thb;
                break;
        }
        $amount = (($round == false) ? $amount : $this->round(1, $amount));
        $amount = (($format == false) ? $amount : $this->format(1, $amount));

        return $amount;
    }

    /**
     * @param $currencyID
     * @param $amount
     * @param null $exchangeID
     * @param bool $round
     * @return float
     */
    public function toUSD($currencyID, $amount, $exchangeID = null, $round = false, $format= false)
    {
        $this->_setExchange($exchangeID);
        switch ($currencyID) {
            case 1:
                $amount = ($amount * $this->usd) / $this->khrUSD;
                break;
            case 2:
                $amount = $amount;
                break;
            case 3:
                $amountKHR = ($amount * $this->khrTHB) / $this->thb;
                $amount = ($amountKHR * $this->usd) / $this->khrUSD;
                break;
        }
        $amount = (($round == false) ? $amount : $this->round(2, $amount));
        $amount = (($format == false) ? $amount : $this->format(2, $amount));

        return $amount;
    }

    /**
     * @param $currencyID
     * @param $amount
     * @param null $exchangeID
     * @param bool $round
     * @return float
     */
    public function toTHB($currencyID, $amount, $exchangeID = null, $round = false, $format= false)
    {
        $this->_setExchange($exchangeID);
        switch ($currencyID) {
            case 1:
                $amount = ($amount * $this->thb) / $this->khrTHB;
                break;
            case 2:
                $amountKHR = ($amount * $this->khrUSD) / $this->usd;
                $amount = ($amountKHR * $this->thb) / $this->khrTHB;
                break;
            case 3:
                $amount = $amount;
                break;
        }
        $amount = (($round == false) ? $amount : $this->round(3, $amount));
        $amount = (($format == false) ? $amount : $this->format(3, $amount));

        return $amount;
    }

    /**
     * @param $exchangeID
     */
    private function _setExchange($exchangeID)
    {
        if (!is_null($exchangeID)) {
            $data = Exchange::find($exchangeID);
            $this->khrUSD = $data->khr_usd;
            $this->usd = $data->usd;
            $this->khrTHB = $data->khr_thb;
            $this->thb = $data->thb;
        }
    }

}