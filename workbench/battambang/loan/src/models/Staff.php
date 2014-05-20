<?php

namespace Battambang\Loan;

use Eloquent;
class Staff extends Eloquent {

	protected $table = 'ln_staff';
    protected $primaryKey='id';
	public $timestamps = true;
	protected $softDelete = false;

    public function disburses(){
        return $this->hasMany('Disburse');
    }

    public function centers(){
        return $this->hasMany('Center');
    }

    public function office(){
        return $this->belongsTo('Office',"cp_office_id");
    }

    public function gender(){
        return $this->belongsTo('LookupValue','ln_lv_gender');
    }

    public function maritalStatus(){
        return $this->belongsTo('LookupValue','ln_lv_marital_status');
    }

    public function education(){
        return $this->belongsTo('LookupValue','ln_lv_education');
    }

    public function idType(){
        return $this->belongsTo('LookupValue','ln_lv_id_type');
    }

    public function title(){
        return $this->belongsTo('LookupValue','ln_lv_title');
    }
}
