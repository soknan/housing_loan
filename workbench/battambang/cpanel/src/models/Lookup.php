<?php

namespace Battambang\Cpanel;
use Eloquent;

class Lookup extends Eloquent {

	protected $table = 'cp_lookup';
	public $timestamps = true;
	protected $softDelete = false;

	public function lookupValue()
	{
		return $this->hasMany('Battambang\Cpanel\LookupValue', 'cp_lookup_id');
	}

}