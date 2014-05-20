<?php
namespace Battambang\Loan;

use Eloquent;
class DisburseClient extends Eloquent {

	protected $table = 'ln_disburse_client';
    protected $PrimaryKey='id';
	public $timestamps = true;
	protected $softDelete = false;

    public function schedules(){
        return $this->hasMany ('Schedule');
    }
    public function performs (){
        return $this->hasMany('Perform');
    }
    public function history(){
        return $this->belongsTo('LookupValue','ln_lv_history');
    }

    public function purpose(){
        return $this->belongsTo('LookupValue','ln_lv_purpose');
    }

    public function activity(){
        return $this->belongsTo('LookupValue','ln_lv_activity');
    }

    public function collateralType(){
        return $this->belongsTo('LookupValue','ln_lv_collateral_type');
    }

    public function security(){
        return $this->belongsTo('LookupValue','ln_lv_security');
    }

    public function idType(){
        return $this->belongsTo('LookupValue','ln_lv_id_type');
    }

    public function maritalStatus(){
        return $this->belongsTo('LookupValue','ln_lv_marital_status');
    }

    public function education(){
        return $this->belongsTo('LookupValue','ln_lv_education');
    }

    public function business(){
        return $this->belongsTo('LookupValue','ln_lv_business');
    }

    public function poverty(){
        return $this->belongsTo('LookupValue','ln_lv_status');
    }

    public function handicap(){
        return $this->belongsTo('LookupValue','ln_lv_handicap');
    }

    public function contactType(){
        return $this->belongsTo('LookupValue','ln_lv_contact_type');
    }
}
