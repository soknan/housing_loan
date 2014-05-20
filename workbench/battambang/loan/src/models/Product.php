<?php

namespace Battambang\Loan;

use Eloquent;
class Product extends Eloquent
{

    protected $table = 'ln_product';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $softDelete = false;
    public function disburse (){
        return $this-> hasMany ('Disburse');
    }

    public function category(){
        return $this->belongsTo('Category', 'ln_category_id');
    }

    public function fee(){
        return $this->belongsTo('Fee', 'ln_fee_id');
    }

    public function accountType(){
        return $this->belongsTo('LookupValue','ln_lv_account_type_arr');
    }

    public function repayFrequency(){
    return $this->belongsTo('LookupValue','ln_lv_repay_frequency');
}

    public function holidayRule(){
        return $this->belongsTo('LookupValue','ln_lv_holiday_rule');
    }

    public function interestType(){
        return $this->belongsTo('LookupValue','ln_lv_interest_type');
    }

    public function amountType(){
        return $this->belongsTo('LookupValue','ln_lv_amount_type');
    }

    public function penalty (){
        return $this->belongsTo('Penalty','ln_penalty_id');
    }

    public function penaltyClosing(){
        return $this->belongsTo('PenaltyClosing','ln_penalty_closing_id');
    }
}