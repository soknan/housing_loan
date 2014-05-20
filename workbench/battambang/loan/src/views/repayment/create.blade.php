@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.repayment.store'))->method('POST')}}

<?php
$activated_at = '';
$totalPrincipal=0;
$interest=0;
$penalty=0;
$option ='';
$client_id ='';
if(Session::has('data')){
    $perform = Session::get('data');
    $activated_at = Carbon::createFromFormat('Y-m-d',$perform->_activated_at)->format('d-m-Y') ;
    $totalPrincipal = $perform->_arrears['cur']['principal'] + $perform->_arrears['cur']['interest'];
    $interest = $perform->_arrears['cur']['interest'];
    $penalty = $perform->_arrears['cur']['penalty'];
    $option = $perform->_repayment['cur']['type'];
    $client_id = $perform->_disburse_client_id;
}

echo FormPanel2::make(
    'General',
    Former::text('repayment_date', 'Date',$activated_at)->append('dd-mm-yyyy')->required() . ''
    .Former::select('ln_disburse_client_id', 'Loan Acc #')
//        ->options($disburseClient, $client_id)
        ->options(LookupValueList::getLoanAccount(), $client_id)
        ->placeholder('- Select One -')
        ->class('select2')
        ->required()
    .Former::select('repayment_status', 'Type')
        ->options($status,$option)
        ->class('select2')
        ->required()
    ,
  Former::number('repayment_principal','Repayment Amount',$totalPrincipal)
      ->step('0.01')->min(0)
      ->required()
   .Former::number('repayment_penalty', 'penalty',$penalty)
      ->step('0.01')->min(0)->required(). ''
    .Former::text('repayment_voucher_id',' Voucher ID')
      ->maxlength(6)
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

