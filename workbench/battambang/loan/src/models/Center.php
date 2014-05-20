<?php

namespace Battambang\Loan;

use Eloquent;
class Center extends Eloquent {

	protected $table = 'ln_center';
    protected $primaryKey='id';
	public $timestamps = true;
	protected $softDelete = false;
    public function disburses(){
        return $this->hasMany ('Disburse');
    }

    public function lookupValue (){
        return $this->belongsTo('LookupValue','ln_lv_geography');
    }

    public function location(){
        return $this->belongsTo('Location','cp_location_id');
    }

    public function staff(){
        return $this->belongsTo('Staff','ln_staff_id');
    }
    public function office(){
        return $this->belongsTo('Office','cp_office_id');
    }
}
