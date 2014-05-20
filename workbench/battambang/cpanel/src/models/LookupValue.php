<?php

namespace Battambang\Cpanel;
use Eloquent;

class LookupValue extends Eloquent {

	protected $table = 'cp_lookup_value';
	public $timestamps = true;
	protected $softDelete = false;

	public function lookup()
	{
		return $this->belongsTo('Battambang\Cpanel\Lookup');
	}

}