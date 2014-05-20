<?php

namespace Battambang\Loan;

use Eloquent;
class PenaltyClosing extends Eloquent {

	protected $table = 'ln_penalty_closing';
    protected $primaryKey='id';
	public $timestamps = true;
	protected $softDelete = false;
    public function products (){
        return $this->hasMany('Product');
    }
}