<?php

namespace Battambang\Loan;

use Eloquent;
class WriteOffRule extends Eloquent {

	protected $table = 'ln_write_off_rule';
    protected $primaryKey='id';
	public $timestamps = true;
	protected $softDelete = false;

}