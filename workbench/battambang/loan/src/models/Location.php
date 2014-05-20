<?php

namespace Battambang\Loan;

use Eloquent;
class Location extends Eloquent {

	protected $table = 'cp_location';
    protected $primaryKey='id';
	public $timestamps = true;
	protected $softDelete = false;
    public function centers(){
        return $this->hasMany('Center');
    }
}