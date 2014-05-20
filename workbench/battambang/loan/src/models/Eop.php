<?php

namespace Battambang\Loan;

use Eloquent;
class Eop extends Eloquent {

	protected $table = 'ln_eop';
    protected $primaryKey='id';
	public $timestamps = true;
	protected $softDelete = false;

}