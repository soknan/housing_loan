@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('cpanel.office.update',$row->id))->method('PUT')}}

<?php
echo FormPanel2::make(
    'General',
    Former::text('kh_name', 'Kh Name', $row->kh_name)->required() . ''
    . Former::text('kh_short_name', 'Kh Short Name', $row->kh_short_name)->required()
    . Former::text('en_name', 'En Name', $row->en_name)->required()
    ,
    Former::text('en_short_name', 'En Short Name',$row->en_short_name)->required() . ''
    . Former::text('register_at', 'Register Date', date('d-m-Y', strtotime($row->register_at)))
        ->append('dd-mm-yyyy')
    . Former::select('cp_office_id', 'Main Office', GetLists::getAllBranchList(), $row->cp_office_id)->class('select2')
);

echo FormPanel2::make(
    'Contact',
    Former::textarea('kh_address', 'Kh Address', $row->kh_address)->required() . ''
    . Former::textarea('en_address', 'En Address', $row->en_address)->required()
    ,
    Former::text('telephone', 'Telephone', $row->telephone)->required() . ''
    . Former::text('email', 'Email', $row->email)
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