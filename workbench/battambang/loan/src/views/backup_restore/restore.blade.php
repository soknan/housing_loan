@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')
{{Former::open( route('loan.restore.restore'))->method('POST')->enctype('multipart/form-data')}}

<?php
echo FormPanel2::make(
    'Restore Database',
    Former::select('package', 'Package')
        ->options(GetLists::getPackageList())
        ->placeholder('--Select One--')
        ->required() . ''
    .Former::select('branch[]', 'Branch Office')
    ->options(GetLists::getSubBranchListNoAjax(UserSession::read()->package))
    ->multiple('multiple')
    ->required() . ''
    ,
    Former::select('table[]', 'Table')
        ->options($table)
        ->multiple('multiple')
        /*->class('select2')*/
        ->required() . ''
    .Former::file('file_to_restore', 'File')->required().''

);
?>
<div class="text-center">
    {{ Former::lg_primary_submit('Restore'). '&nbsp;' . Former::lg_inverse_reset('Reset')}}
</div>
{{Former::close()}}
@stop

