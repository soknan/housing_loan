@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')
{{Former::open( route('loan.backup.backup'))->method('POST')->id('my_form')}}

<?php
echo FormPanel2::make(
    'Backup Database',
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
);

?>

<div class="text-center">
    {{ Former::lg_primary_submit('Backup'). '&nbsp;' . Former::lg_inverse_reset('Reset')}}
</div>
{{Former::close()}}

@stop
<!--@section('js')
    <?php
/*    echo FormerAjax::make('my_form', 'package', 'change', URL::to('loan/package/package_change'))
        ->getChange(array("branch" => 'html(data.branch)'));
    */?>
@stop-->

