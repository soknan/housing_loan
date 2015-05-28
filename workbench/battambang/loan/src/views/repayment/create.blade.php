@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.repayment.store'))->method('POST')}}

<?php
$activated_at = date('d-m-Y');
$totalPrincipal=0;
$interest=0;
$penalty=0;
$option ='';
$client_id ='';
$onlyFee = false;
if(Session::has('data')){
    $perform = Session::get('data');
    $activated_at = Carbon::createFromFormat('Y-m-d',$perform->_activated_at)->format('d-m-Y') ;
    $totalPrincipal = $perform->_arrears['cur']['principal'] + $perform->_arrears['cur']['interest'];
    $interest = $perform->_arrears['cur']['interest'];
    $penalty = $perform->_arrears['cur']['penalty'];
    $option = $perform->_repayment['cur']['type'];
    $client_id = $perform->_disburse_client_id;

    if( $perform->_repayment['cur']['type']=='fee'){
        $onlyFee=true;
    }
}

echo FormPanel2::make(
    'General',
    Former::select('ln_disburse_client_id', 'Acc#')
//        ->options($disburseClient, $client_id)
        ->options(LookupValueList::getLoanAccount(), $client_id)
        ->placeholder('--Select One--')
        ->class('select2')
        ->required()
    .Former::text('repayment_date', 'Date',$activated_at)
            ->append('dd-mm-yyyy')->required()
            //->readonly($onlyFee) . ''
    //.Former::text('repayment_date', 'Date', date('d-m-Y'))->append('dd-mm-yyyy')->required()->readonly($onlyFee) . ''

    .Former::select('repayment_status', 'Type')
        ->options($status,$option)
        ->class('select2')
        ->required()
    ,
  Former::number('repayment_principal','Amount',$totalPrincipal)
      ->step('0.01')->min(0)
      //->readonly($onlyFee)
      ->required()
   .Former::number('repayment_penalty', 'penalty',$penalty)
      ->step('0.01')->min(0)->required()
      //->readonly($onlyFee). ''
    .Former::text('repayment_voucher_id',' Voucher')
          ->maxlength(6)
);
?>

<div class="text-center">
    {{ Former::lg_info_submit('Confirm')->name('confirm') . '&nbsp;' .Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop

@section('js')

<?php
if($onlyFee==false){
    echo DatePicker::make('repayment_date');
}
?>

<script>
<?php
if($onlyFee){
    echo "$('#repayment_date').prop('readonly', true);";
    echo "$('#repayment_principal').prop('readonly', true);";
    echo "$('#repayment_penalty').prop('readonly', true);";
}
?>
</script>
@stop
