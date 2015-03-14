<?php

namespace Battambang\Loan;

use Eloquent;
class PrePaid extends Eloquent {

	protected $table = 'ln_pre_paid';
    protected $primaryKey ='id';
	public $timestamps = true;
	protected $softDelete = false;

}