@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open(route('cpanel.group.update', $record->id))->method('put')->id('my_form')}}

<?php
echo FormPanel2::make(
    'General',
     Former::text('group_name', 'Group Name', $record->name)->required() . ''
    . Former::select('branch_office[]', 'Office')
        ->id('branch_office')
        ->options(GetLists::getSubBranchList(), json_decode($record->branch_arr, true))
        ->multiple()
        ->size(10)
    . ''
    ,
    Former::select('package', 'Package Name')
        ->options(GetLists::getAllPackageList(), $record->package)
        ->required()
        ->placeholder('- Select One -') . ''
    . Former::select('permission[]', 'Permission')
        ->id('permission')
        ->options(GetLists::getAllMenuList($record->package), json_decode($record->permission_arr, true))
        ->multiple()
        ->size(10)
        ->required() . ''
);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit')->name('submit')->id('submit') . '&nbsp;' . Former::lg_inverse_reset('Reset')
    }}
</div>

{{Former::close()}}
@stop

@section('js')
<?php
echo FormerAjax::make('my_form', 'package', 'change', URL::to('cpanel/group/package_change'))
    ->getChange(array('permission' => 'html(data.permission)'));
echo FormerAjax::make('my_form', 'submit', 'click', URL::to('cpanel/group/update', array($record->id)))
    ->getSave('alert', 'html(data.alert)');
?>
@stop