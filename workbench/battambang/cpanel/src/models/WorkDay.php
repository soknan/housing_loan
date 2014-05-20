<?php

namespace Battambang\Cpanel;

use Eloquent;

class WorkDay extends Eloquent
{

    public  $table = 'cp_workday';
    public  $primaryKey = 'id';
    public $timestamps = true;
    public  $softDelete = false;

    public function lookupValue()
    {
        return $this->belongsTo('Battambang\Cpanel\LookupValue');
    }
}