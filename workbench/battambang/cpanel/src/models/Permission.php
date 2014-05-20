<?php namespace Battambang\Cpanel;
use Eloquent;
class Permission extends Eloquent {

	protected $table = 'cp_permission';
	public $timestamps = true;
	protected $softDelete = false;

}