<?php
namespace Battambang\Loan;

use Eloquent;
class Schedule extends Eloquent {

	protected $table = 'ln_schedule';
    protected $primaryKey='id';
    public $timestamps = true;
	protected $softDelete = false;

    public function scheduleDts(){
        return $this->hasMany('ScheduleDt');
    }

    public function disburseClient(){
        return $this->belongsTo('DisburseClient','ln_disburse_client_id');
    }
}