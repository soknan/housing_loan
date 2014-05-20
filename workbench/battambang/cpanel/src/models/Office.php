<?php

namespace Battambang\Cpanel;
use Eloquent;
class Office extends Eloquent {

	protected $table = 'cp_office';
	public $timestamps = true;
	protected $softDelete = false;

}