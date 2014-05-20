<?php

namespace Battambang\Loan;

use Eloquent;
class Office extends Eloquent
{
    protected $table = 'ln_office';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $softDelete = false;

    public function centers(){
        return $this->hasMany('Center');
    }

    public function clientLoans(){
        return $this->hasMany('ClientLoan');
    }

    public function staffs(){
        return $this->hasMany('Staff');
    }
}
