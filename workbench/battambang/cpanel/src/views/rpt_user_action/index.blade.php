@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')
{{Former::open( route('cpanel.rpt_user_action.report'))->method('POST')}}
<?php echo FormPanel2::make(
    'General',
    Former::select('cp_office_id[]','Branch Office')
        ->options(\GetLists::getSubBranchList(json_decode(\UserSession::read()->branch_arr, true)))
        ->multiple('multiple')
        ->required()
        .''
.Former::select('event','Event')
        ->options(array('all'=>'All','add'=>'Add','edit'=>'Edit','delete'=>'Delete','backup'=>'Backup','restore'=>'Restore'))
        ->required().''
    .Former::select('user','User')
            ->options(array('all'=>'All'))
            ->options($userLst)
            ->required()
    ,
    Former::text('date_from','From',date('d-m-Y'))->append('dd-mm-yyyy')->required().''
    .Former::text('date_to','To',date('d-m-Y'))->append('dd-mm-yyyy')->required().''

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

