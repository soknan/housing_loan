<?php

namespace Battambang\Cpanel;
use Eloquent;

class Group extends Eloquent {

	protected $table = 'cp_group';
	public $timestamps = true;
	protected $softDelete = false;
}