<?php

namespace Battambang\Cpanel;
use Eloquent;

class Company extends Eloquent {

	protected $table = 'cp_company';
	public $timestamps = true;
	protected $softDelete = false;

}