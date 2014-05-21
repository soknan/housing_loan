@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')
{{Former::open( route('loan.restore.restore'))->method('POST')->enctype('multipart/form-data')}}

<?php
echo FormPanel2::make(
    'Restore Database',
    Former::hidden('package', \UserSession::read()->package) . ''
    . Former::select('branch[]', 'Branch Office')
        ->options(\GetLists::getSubBranchList(json_decode(\UserSession::read()->branch_arr, true)))
        ->multiple('multiple')
        ->size(7)
        ->required() . ''
    ,
    Former::select('table[]', 'Table')
        ->options($table)
        ->multiple('multiple')
        ->size(4)
        ->required() . ''
    . Former::file('file_to_restore', 'File')->required() . ''

);
?>
<div class="text-center">
    {{ Former::lg_primary_submit('Restore'). '&nbsp;' . Former::lg_inverse_reset('Reset')}}
</div>
{{Former::close()}}
@stop

