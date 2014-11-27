<?php

namespace Battambang\Cpanel;
use Eloquent;

class Location extends Eloquent {

	protected $table = 'cp_location';
	public $timestamps = true;
	protected $softDelete = false;

}