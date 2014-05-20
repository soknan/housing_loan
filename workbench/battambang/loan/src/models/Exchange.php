<?php

namespace Battambang\Loan;

use Eloquent;
class Exchange extends Eloquent {

	protected $table = 'ln_exchange';
    protected $primaryKey='id';
	public $timestamps = true;
	protected $softDelete = false;

}