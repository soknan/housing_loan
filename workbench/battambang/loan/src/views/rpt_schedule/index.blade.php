@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')
{{Former::open( route('loan.rpt_schedule.report'))->method('POST')}}
{{ FormPanel2::make(
    'General',
    Former::select('ln_disburse_client_id','Loan Acc #')
    ->options(LookupValueList::getLoanAccount())
    ->class('select2')
    ->required().'',
    Former::text('view_at','Date',date('d-m-Y'))->append('dd-mm-yyyy')->required()
) }}

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>

<!--FormPanel2::make('
    <a href="#" class="btn btn-primary" rel="tooltip" data-placement="top"
       data-original-title="Refresh" data-toggle="modal"
       onclick="document.location.reload(true);">
        <i class="icon-repeat"></i>
    </a> Report History (Last 5 Views)',
    $reportHistory
)}}
{{ Former::close()-->

@stop
@section('js')
<?php
echo DatePicker::make('view_at');
?>
@stop

