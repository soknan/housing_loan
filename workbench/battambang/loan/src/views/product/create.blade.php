@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.product.store'))->method('POST')}}

<?php
echo FormPanel2::make(
    'General',
    Former::select('ln_category_id', 'Category', \LookupValueList::getCategory())
        ->placeholder('--Select One--')->required() . ''
    . Former::text('name', 'Name')
        ->required()
    . Former::textarea('des', 'Description')
        ->required()
    . Former::text('start_date', 'Start Date')
        ->required()
        ->append('dd-mm-yyyy')
    ,
    Former::text('end_date', 'End Date')
        ->required()
        ->append('dd-mm-yyyy') . ''
    . Former::select('ln_lv_account_type_arr[]', 'Account')
        ->options(\LookupValueList::getBy('account type'))
        ->multiple('multiple')
        /*->class('select2')*/
        ->required()
    . Former::select('cp_currency_id_arr[]', 'Currency')
        ->options(\LookupValueList::getCurrency())
        ->multiple('multiple')
        /*->class('select2')*/
        ->required()
);

echo FormPanel2::make(
    'Repayment',
    Former::select('ln_lv_repay_frequency', 'Frequency', \LookupValueList::getBy('repay frequency'))
//Former::select('ln_lv_repay_frequency', 'Frequency', \LookupValueList::getBy('repay frequency', ' and ln_lookup_value.id = 3')) // 3-Weekly, 4-Monthly
        ->required()
         . ''
    . Former::number('min_installment', 'Min')
        ->required()->min(0)
    . Former::number('max_installment', 'Max')
        ->required()->min(0)
    ,
    Former::number('default_installment', 'Default')
        ->required()->min(0) . ''
    . Former::select('ln_lv_holiday_rule', 'Holiday', \LookupValueList::getBy('holiday rule'))
        ->required()

);

echo FormPanel2::make(
    'Interest',
    Former::select('ln_lv_interest_type', 'Type', \LookupValueList::getBy('interest type'))
        ->required()
         . ''
    . Former::number('min_interest', 'Min')
        ->step('0.01')->min(0)
        ->required()
    ->append('%')
    ,
    Former::number('max_interest', 'Max')
        ->required()
        ->step('0.01')->min(0)
        ->append('%')
    . ''
    . Former::number('default_interest', 'Default')
        ->required()
        ->step('0.01')->min(0)
        ->append('%')
);

echo FormPanel2::make(
    'Loan Amount',
//    Former::select('ln_lv_loan_amount_type', 'Amount Type')
//        ->options( \LookupValueList::getBy('LoanAmountType',' limit 1'))
//        ->required()
//        ->placeholder('--Select One--') . ''
    Former::hidden('ln_lv_loan_amount_type')
        ->value(10)// for 'None'
    . Former::number('min_amount', 'Min')
        ->required()
        ->step('0.01')->min(0)
    ->append('USD')
       . Former::number('max_amount', 'Max')
            ->required()->step('0.01')->min(0)
            ->append('USD')
    ,
    Former::number('default_amount', 'Default')
        ->required()
        ->step('0.01')->min(0)
        ->append('USD').''
//    . Former::select('ln_exchange_id', 'Exchange')
//        ->options(LookupValueList::getExchange())
//        ->placeholder('--Select One--')
//        ->class('select2')
//        ->required()

);

echo FormPanel2::make(
    'Others',
    Former::select('ln_fee_id', 'Fee', \LookupValueList::getFee())
        ->required()
        ->placeholder('--Select One--') . ''
    . Former::select('ln_penalty_id', 'Penalty', \LookupValueList::getPenalty())
        ->required()
        ->placeholder('--Select One--')
    .Former::select('ln_penalty_closing_id', 'Penalty Closing', \LookupValueList::getPenaltyClosing())
        ->required()
        ->placeholder('--Select One--').''

    ,
    Former::select('ln_fund_id_arr[]', 'Fund')
        ->options(\LookupValueList::getFund())
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
    <script>
        $(document).ready(function () {
            var r = $('[name="ln_lv_repay_frequency"]');
            var h = $('[name="ln_lv_holiday_rule"]');
            $('[name="ln_lv_repay_frequency"]').change(function(){
                h.val('');
                if(r.val()==130){
                    h.find('[value="7"]').hide();
                }else{
                    h.find('[value="7"]').show();
                }
            });

        });
    </script>
<?php
echo DatePicker::make('start_date');
echo DatePicker::make('end_date');
?>
@stop
