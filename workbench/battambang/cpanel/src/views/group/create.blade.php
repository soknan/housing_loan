@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open(route('cpanel.group.store'))->method('post')->id('my_form')}}

<?php
echo FormPanel2::make(
    'General',
    Former::text('group_name', 'Group Name')->required() . ''
    . Former::select('branch_office[]', 'Office')
        ->id('branch_office')
        ->options(GetLists::getSubBranchList())
        ->multiple()
        ->size(10)
         . ''
    ,
    Former::select('package', 'Package Name')
        ->options(GetLists::getAllPackageList())
        ->required()
        ->placeholder('- Select One -'). ''
    . Former::select('permission[]', 'Permission')
        ->id('permission')
        ->multiple()
        ->size(10)
        ->required() . ''
);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit')->name('submit')->id('submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>

{{Former::close()}}
@stop

@section('js')
<?php
echo FormerAjax::make('my_form', 'package', 'change', URL::route('cpanel.group.package_change'))
    ->getChange(array('permission' => 'html(data.permission)'));
echo FormerAjax::make('my_form', 'submit', 'click', URL::route('cpanel.group.index'))
    ->getSave('alert', 'html(data.alert)');
?>
@stop