<?php

namespace Battambang\Loan;

use Eloquent;
class Disburse extends Eloquent {

	protected $table = 'ln_disburse';
    public $primaryKey='id';
	public $timestamps = true;
   	protected $softDelete = false;

    public function clientLoans(){
        $this->belongsToMany('clientLoans', 'ln_client_id', 'ln_disburse_client', 'ln_disburse_id')
            ->withPivot('id', 'amount','voucher_id', 'cycle','ln_lv_history', 'ln_lv_purpose',
                'purpose','purpose_des','ln_lv_activity','ln_lv_collateral','collateral_des',
                'ln_lv_security','ln_lv_id_type','id_num','expire_date','ln_lv_marital_status',
                'family_member','num_dependent','ln_lv_education','ln_lv_business','ln_lv_handicap',
                'address','ln_lv_contact_type','contact_type','contact_num','email')
            ->withTimestamps();
    }
    public function meetingSchedule (){
        return $this->belongsTo('LookupValue','ln_lv_meeting_schedule');
    }

    public function accountType (){
        return $this->belongsTo('LookupValue','ln_lv_account_type');
    }

    public function currency (){
        return $this->belongsTo('Currency','ln_currency');
    }

    public function product (){
        return $this->belongsTo('Product','ln_product_id');
    }

    public function fund (){
        return $this->belongsTo('Fund','ln_fund_id');

    }

    public function staff (){
        return $this->belongsTo('Staff','ln_staff_id');
    }
    public function center(){
        return $this->belongsTo('Center','ln_center_id');
    }

}