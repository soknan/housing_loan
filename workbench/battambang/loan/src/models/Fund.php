<?php

namespace Battambang\Loan;

use Eloquent;
class Fund extends Eloquent {

	protected $table = 'ln_fund';
    protected $primaryKey ='id';
	public $timestamps = true;
	protected $softDelete = false;

    public function disburses(){
        return $this->hasMany('Disburse');
    }
}