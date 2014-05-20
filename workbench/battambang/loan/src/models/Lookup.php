<?php

namespace Battambang\Loan;

use Eloquent;
class Lookup extends Eloquent {

	protected $table = 'ln_lookup';
    protected $primaryKey='id';
	public $timestamps = true;
	protected $softDelete = false;
    public function lookupValues(){
        return $this->hasMany('LookupValue');
    }

}