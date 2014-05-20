<?php

namespace Battambang\Loan;

use Eloquent;
class Currency extends Eloquent {

	protected $table = 'cp_currency';
    protected $primaryKey='id';
	public $timestamps = true;
	protected $softDelete = false;

    public function disburses(){
        return $this->hasMany('Disburse');
    }

}