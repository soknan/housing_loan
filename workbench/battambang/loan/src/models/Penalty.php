<?php

namespace Battambang\Loan;

use Eloquent;
class Penalty extends Eloquent {

	protected $table = 'ln_penalty';
    protected $primaryKey='id';
	public $timestamps = true;
	protected $softDelete = false;

    public function products() {
        return $this->hasMany('Product');
    }

    public function penaltyType(){
        return $this->belongsTo('LookupValue','ln_lv_penalty_type');
    }

    public function calculateType(){
        return $this->belongsTo('LookupValue','ln_lv_calculate_type');
    }

    public function percentageOf() {
        return $this->belongsTo('LookupValue','ln_lv_percentage_of');
    }
}