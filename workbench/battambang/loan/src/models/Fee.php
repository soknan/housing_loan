<?php

namespace Battambang\Loan;

use Eloquent;
class Fee extends Eloquent
{

    protected $table = 'ln_fee';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $softDelete = false;

    public function products()
    {
        return $this->hasMany('Product');
    }

    public function feeType (){
        return $this->belongsTo('LookupValue','ln_lv_fee_type');
    }

    public function calculateType (){
        return $this->belongsTo('LookupValue','ln_lv_calculate');
    }
    public function percentageOf (){
        return $this->belongsTo('LookupValue','ln_lv_percentage_of');
    }
}