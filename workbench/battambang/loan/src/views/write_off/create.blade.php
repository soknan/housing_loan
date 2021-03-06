@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.write_off.store'))->method('POST')->enctype('multipart/form-data')}}

<?php
/*$activated_at = '';
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
    $option = $perform->_repayment['cur']['status'];
    $client_id = $perform->_disburse_client_id;
}*/

echo FormPanel2::make(
    'General',
    Former::text('writeoff_date', 'Date',date('d-m-Y'))
        ->append('dd-mm-yyyy')
        ->required() . ''
    .Former::select('ln_disburse_client_id', 'Loan Account')
//        ->options($disburseClient)
        ->options(LookupValueList::getLoanAccount())
        ->class('select2')
        ->required().''
    ,Former::file('writeoff_ref','Write-Off Ref')

);
?>

<div class="text-center">
    {{ Former::lg_info_submit('Confirm')->name('confirm') . '&nbsp;' .Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop
@section('js')
<?php echo DatePicker::make('writeoff_date'); ?>
@stop

