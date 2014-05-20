@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('cpanel.office.store'))->method('POST')}}
<?php
echo FormPanel2::make(
    'General',
    Former::text('kh_name', 'Kh Name')->required() . ''
    .Former::text('kh_short_name', 'Kh Short Name')->required() . ''
    . Former::text('en_name', 'En Name')->required() . ''
    ,
    Former::text('en_short_name', 'En Short Name')->required() . ''
    . Former::text('register_at', 'Register Date', date('d-m-Y'))
        ->placeholder(' dd-mm-yyyy')
        ->required()
        ->append('<span class="glyphicon glyphicon-calendar"></span>') . ''
    . Former::select('cp_office_id', 'Main Office', GetLists::getAllBranchList())->class('select2') . ''
);

echo FormPanel2::make(
    'Contact',
    Former::textarea('kh_address', 'Kh Address')->required() . ''
    . Former::textarea('en_address', 'En Address')->required()
    ,
    Former::text('telephone', 'Telephone')->required() . ''
    . Former::text('email', 'Email')
);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>

{{Former::close()}}

@stop

@section('js')
<?php echo DatePicker::make('register_at'); ?>
@stop