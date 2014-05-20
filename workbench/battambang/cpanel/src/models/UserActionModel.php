<?php

namespace Battambang\Cpanel;

use Eloquent;

class UserActionModel extends Eloquent
{

    protected $table = 'cp_user_action';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = true;
    protected $softDelete = false;

    public function setUpdatedAtAttribute($value)
    {
        //
    }

}