<?php

namespace Battambang\Loan;

use Eloquent;
class LookupValue extends Eloquent {

	protected $table = 'ln_lookup_value';
    protected $primaryKey='id';
	public $timestamps = true;
	protected $softDelete = false;
    public function disburseClients(){
        return $this->hasMany('DisburseClint');
    }

    public function staffs(){
        return $this->hasMany('Staff');
    }

    public function clientLoans(){
        return $this->hasMany('ClientLoan');
    }
    public function penaltys(){
        return $this->hasMany('Penalty');
    }

    public function centers(){
        return $this->hasMany('Center');
    }

    public function products() {
        return $this->hasMany('Product');
    }

    public function disburses(){
        return $this->hasMany('Disburse');
    }

    public function fees(){
        return $this->hasMany('Fee');
    }

    public function lookup(){
        return $this->belongsTo('Lookup', 'ln_lookup_id');
    }
}