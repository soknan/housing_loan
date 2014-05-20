@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')
{{Former::open(route('cpanel.company.update',$row->id),'PUT')->enctype('multipart/form-data')}}

<?php
echo FormPanel2::make(
    'General',
    Former::textarea('kh_name', 'Kh Name', $row->kh_name)
        ->required() . ''
    . Former::textarea('kh_short_name', 'Kh Short Name', $row->kh_short_name)
        ->required()
    . Former::textarea('en_name', 'En Name', $row->en_name)
        ->required()
    . Former::textarea('en_short_name', 'En Short Name', $row->en_short_name)
        ->required()
    ,
    Former::text('register_at', 'Register Date', date('d-m-Y', strtotime($row->register_at)))
        ->required()
        ->placeholder(' dd-mm-yyyy')
        ->append('<span class="glyphicon glyphicon-calendar"></span>') . ''
    . Former::file('logo', 'Logo')
    . '<div class="row text-center"><img src="' . $row->logo . '" width="100px" height="100px"/></div>'
);

echo FormPanel2::make(
    'Contact',
    Former::textarea('kh_address', 'Kh Address', $row->kh_address)
        ->required() . ''
    . Former::textarea('en_address', 'En Address', $row->en_address)
        ->required()
    . Former::textarea('telephone', 'Telephone', $row->telephone)
        ->required()
    ,
    Former::textarea('email', 'Email', $row->email) . ''
    . Former::textarea('website', 'Website', $row->website)
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

