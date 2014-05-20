<?php

namespace Battambang\Loan;

use Eloquent;
class Provision extends Eloquent {

	protected $table = 'ln_provision';
    protected $primaryKey='id';
	public $timestamps = true;
	protected $softDelete = false;

}