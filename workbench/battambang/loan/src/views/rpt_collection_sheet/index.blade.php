@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')
{{Former::open( route('loan.rpt_collection_sheet.report'))->method('POST')}}
<?php echo FormPanel2::make('General',
    Former::select('cp_office_id[]','Branch Office')
        ->options(\GetLists::getSubBranchList(json_decode(\UserSession::read()->branch_arr, true)))
        ->multiple('multiple')
        ->required()
        .''
    .Former::select('ln_staff_id','Staff Name')
        ->options(array('all'=>'All'))
        ->options(LookupValueList::getStaff())
        ->class('select2')
        .''
    .Former::select('cp_currency_id','Currency')
        ->options(array('all'=>'All'))
        ->options(LookupValueList::getCurrency())
        ->class('select2')
        .''
    .Former::select('ln_fund_id','Fund')
        ->options(array('all'=>'All'))
        ->options(LookupValueList::getFund())
        ->class('select2')
        .''
    .Former::select('ln_product_id','Product')
        ->options(array('all'=>'All'))
        ->options(LookupValueList::getProduct())
        ->class('select2')
        .''
    .Former::select('account_type','Account Type')
        ->options(array('all'=>'All'))
        ->options(\LookupValueList::getBy('account type'))
        ->class('select2')
    .Former::select('ln_lv_repay_frequency','Repay Frequency')
        ->options(array('3'=>'Weekly','4'=>'Monthly'))
        ->class('select2').''
    .'',
    Former::select('location_cat','Location Category')
        ->options(LookupValueList::getLocationCategory())
        ->class('select2')
    .''
    .Former::select('location_cat','Location Category')
        ->options(LookupValueList::getLocationCategory())
        ->class('select2').''
    .Former::select('cp_location_id','Location')
        ->options(array('all'=>'All'))
        ->options(LookupValueList::getLocation())
        ->class('select2')
        .''
    .Former::select('exchange_rate','Exchange')
        ->options(LookupValueList::getExchange())
        ->class('select2')
        ->required().''
    .Former::text('date_from','Date From',date('d-m-Y'))->append('dd-mm-yyyy')->required().''
    .Former::text('date_to','Date To',date('d-m-Y'))->append('dd-mm-yyyy')->required().''
)
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit').'&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>

<!--FormPanel2::make('
    <a href="#" class="btn btn-primary" rel="tooltip" data-placement="top"
       data-original-title="Refresh" data-toggle="modal"
       onclick="document.location.reload(true);">
        <i class="icon-repeat"></i>
    </a> Report History (Last 5 Views)',
    $reportHistory
)
Former::close()-->

@stop
@section('js')
<?php
echo DatePicker::make('date_from');
echo DatePicker::make('date_to');
?>
@stop


