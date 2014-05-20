@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.repayment.update',$row->id))->method('PUT')}}

<?php
$activated_at = $row->activated_at;
$totalPrincipal = $row->repayment_principal + $row->repayment_interest;
$penalty = $row->repayment_penalty;
$option = $row->repayment_payment_status;
$client_id = $row->ln_disburse_client_id;
$voucher_id = substr($row->repayment_voucher_id,-6);
if(Session::has('data')){
    $perform = Session::get('data');
    $activated_at = $perform->_activated_at;
    $totalPrincipal = $perform->_arrears['cur']['principal'] + $perform->_arrears['cur']['interest'];
    $interest = $perform->_arrears['cur']['interest'];
    $penalty = $perform->_arrears['cur']['penalty'];
    $option = $perform->_repayment['cur']['type'];
    $client_id = $perform->_disburse_client_id;
}

echo FormPanel2::make(
    'General',
    Former::text('repayment_date', 'Date',\Carbon::createFromFormat('Y-m-d',$activated_at)->format('d-m-Y'))->required() . ''
    .Former::select('ln_disburse_client_id', 'Loan Account')
//        ->options($disburseClient,$client_id)
        ->options(LookupValueList::getLoanAccount(), $client_id)
        ->required()
        ->readonly('readonly')
        ->class('select2')
    .Former::select('repayment_status', 'Type')
        ->options($status,$option)
        ->class('select2')->required()
    ,
    Former::number('repayment_principal','Repayment Amount',$totalPrincipal)
        ->step('0.01')->min(0)->required()
    .Former::number('repayment_penalty', 'penalty',$penalty)->step(0.01)->min(0)->required().''
    .Former::text('repayment_voucher_id',' Voucher ID',$voucher_id)->maxlength(6)
);
?>
<div class="text-center">
    {{ Former::lg_info_submit('Confirm')->name('confirm') . '&nbsp;' .Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop
@section('js')
<?php echo DatePicker::make('repayment_date'); ?>
@stop
