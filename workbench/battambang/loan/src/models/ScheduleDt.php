<?php

namespace Battambang\Loan;

use Eloquent;
class ScheduleDt extends Eloquent {

	protected $table = 'ln_schedule_dt';
    protected $primaryKey='id';
	public $timestamps = true;
	protected $softDelete = false;

    public function schedule(){
        return $this->belongsTo('Schedule','ln_chedule_id');
    }
}