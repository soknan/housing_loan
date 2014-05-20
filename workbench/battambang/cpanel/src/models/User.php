<?php namespace Battambang\Cpanel;

use Eloquent;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Carbon;

class User extends Eloquent implements UserInterface, RemindableInterface
{

    public $table = 'cp_user';
    public $timestamps = true;
    protected $softDelete = false;
    public $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    public function getRemainDay()
    {
        return $this->_calculate_remain($this->expire_day);
    }

    protected function _calculate_remain($expire_days)
    {
        if ($expire_days == "unlimited") {
            return "unlimited";
        }

        $start_ts = strtotime($this->activated_at);
        $end_ts = strtotime(date("Y-m-d", time()));
        $diff = $end_ts - $start_ts;
        $interval = round($diff / 86400);

        $remain_days = intval($expire_days) - intval($interval);
        return $remain_days;
    }

//    public function setActivatedAtAttribute($value)
//    {
//        $this->attributes['activated_at'] = Carbon::createFromFormat('d-m-Y', $value)
//            ->toDateString();
//    }
//
//    public function getActivatedAtAttribute($value)
//    {
//        return Carbon::createFromFormat('Y-m-d', $value)
//            ->format('d-m-Y');
//    }

}