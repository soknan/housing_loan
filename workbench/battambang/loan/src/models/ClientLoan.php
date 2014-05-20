<?php

namespace Battambang\Loan;

use Eloquent;
class ClientLoan extends Eloquent {

	protected $table = 'ln_client';
    protected $primaryKey='id';
	public $timestamps = true;
	protected $softDelete = false;

    public function disburses(){
        $this->belongsToMany('Disburse', 'ln_disburse_client', 'ln_client_id', 'ln_disburse_id')
            ->withPivot('id', 'amount','voucher_id', 'cycle','ln_lv_history', 'ln_lv_purpose',
                'purpose','purpose_des','ln_lv_activity','ln_lv_collateral','collateral_des',
                'ln_lv_security','ln_lv_id_type','id_num','expire_date','ln_lv_marital_status',
                'family_member','num_dependent','ln_lv_education','ln_lv_business','ln_lv_handicap',
                'address','ln_lv_contact_type','contact_type','contact_num','email')
            ->withTimestamps();
    }

    public function gender(){
        return $this->belongsTo('LookupValue','ln_lv_gender');
    }

    public  function nationality(){
        return $this->belongsTo('LookupValue','ln_lv_nationality');
    }
    public function Office(){
        return $this->belongsTo('Office','cp_office_id');
    }

}
