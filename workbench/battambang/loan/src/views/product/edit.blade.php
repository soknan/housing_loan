@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.product.update',$row->id))->method('PUT')}}

<?php

echo FormPanel2::make(
    'General',
    Former::select('ln_category_id', 'Category', \LookupValueList::getCategory(), $row->ln_category_id)
        ->placeholder('- Select One -')->required() . ''
    . Former::text('name', 'Name', $row->name)
        ->required()
    . Former::textarea('des', 'Description', $row->des)
        ->required()
    . Former::text('start_date', 'Start Date', Carbon::createFromFormat('Y-m-d',$row->start_date)->format('d-m-Y'))
        ->required()
        ->append('dd-mm-yyyy')
    ,
    Former::text('end_date', 'End Date', Carbon::createFromFormat('Y-m-d',$row->end_date)->format('d-m-Y'))
        ->required()
        ->append('dd-mm-yyyy') . ''
    . Former::select('ln_lv_account_type_arr[]', 'Account')
        ->options(\LookupValueList::getBy('account type'),$row->ln_lv_account_type_arr)
        ->multiple('multiple')
        /*->class('select2')*/
        ->required()
    . Former::select('cp_currency_id_arr[]','Currency')
        ->options(\LookupValueList::getCurrency(),$row->cp_currency_id_arr)
        ->multiple('multiple')
        /*->class('select2')*/
        ->required()
);
    //var_dump($arr_currency);

echo FormPanel2::make(
    'Repayment',
    Former::select('ln_lv_repay_frequency', 'Frequency', \LookupValueList::getBy('repay frequency'), $row->ln_lv_repay_frequency)
    //Former::select('ln_lv_repay_frequency', 'Frequency', \LookupValueList::getBy('repay frequency', ' and ln_lookup_value.id = 3'), $row->ln_lv_repay_frequency) // 3-Weekly, 4-Monthly
        ->required()
        ->placeholder('- Select One -') . ''
    . Former::number('min_installment', 'Min', $row->min_installment)
        ->required()->min(0)
    . Former::number('max_installment', 'Max', $row->max_installment)
        ->required()->min(0)
    ,
    Former::number('default_installment', 'Default', $row->default_installment)
        ->required()->min(0) . ''
    . Former::select('ln_lv_holiday_rule', 'Holiday', \LookupValueList::getBy('holiday rule'), $row->ln_lv_holiday_rule)
        ->required()
        ->placeholder('- Select One -')
);

echo FormPanel2::make(
    'Interest',
    Former::select('ln_lv_interest_type', 'Type', \LookupValueList::getBy('interest type'), $row->ln_lv_interest_type)
        ->required()
        ->placeholder('- Select One -') . ''
    . Former::number('min_interest', 'Min', $row->min_interest)
        ->required()
        ->step('0.01')->min(0)
        ->append('%')
    ,
    Former::number('max_interest', 'Max', $row->max_interest)
        ->required()
        ->step('0.01')->min(0)
        ->append('%') . ''
    . Former::number('default_interest', 'Default', $row->default_interest)
        ->required()
        ->step('0.01')
        ->append('%')
);

echo FormPanel2::make(
    'Loan Amount',
//    Former::select('ln_lv_loan_amount_type', 'Amount Type')
//        ->options(\LookupValueList::getBy('LoanAmountType',' limit 1'), $row->ln_lv_loan_amount_type)
//        ->required()
//        ->append('USD')
//        ->placeholder('- Select One -') . ''
    Former::hidden('ln_lv_loan_amount_type')
        ->value(10)// for 'None'
    . Former::number('min_amount', 'Min', $row->min_amount)
        ->append('USD')
        ->step('0.01')->min(0)
        ->required()
    .Former::number('max_amount', 'Max', $row->max_amount)
    ->append('USD')
        ->step('0.01')->min(0)
    ->required()
    ,
    Former::number('default_amount', 'Default', $row->default_amount)
        ->append('USD')
        ->step('0.01')->min(0)
        ->required(). ''
//    . Former::select('ln_exchange_id', 'Exchange')
//        ->options(LookupValueList::getExchange(),$row->ln_exchange_id)
//        ->placeholder('- Select One -')
//        ->class('select2')
//        ->required()

);

echo FormPanel2::make(
    'Others',
    Former::select('ln_fee_id', 'Fee', \LookupValueList::getFee(), $row->ln_fee_id)
        ->required()
        ->placeholder('- Select One -') . ''
    . Former::select('ln_penalty_id', 'Penalty', \LookupValueList::getPenalty(), $row->ln_penalty_id)
        ->required()
        ->placeholder('- Select One -')
    . Former::select('ln_penalty_closing_id', 'Penalty Closing', \LookupValueList::getPenaltyClosing(), $row->ln_penalty_closing_id)
        ->required()
        ->placeholder('- Select One -')
    ,
    Former::select('ln_fund_id_arr[]', 'Fund')
        ->options(\LookupValueList::getFund(), json_decode($row->ln_fund_id_arr))
        ->multiple('multiple')
        /*->class('select2')*/
        ->required() . ''
);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop
@section('js')
<?php
echo DatePicker::make('start_date');
echo DatePicker::make('end_date');
?>
@stop
