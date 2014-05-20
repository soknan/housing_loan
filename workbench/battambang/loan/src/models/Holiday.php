<?php

namespace Battambang\Loan;

use Eloquent;
class Holiday extends Eloquent {

	protected $table = 'ln_holiday';
    protected $primaryKey='id';
	public $timestamps = true;
	protected $softDelete = false;

}