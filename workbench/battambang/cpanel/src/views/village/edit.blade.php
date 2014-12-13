@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('cpanel.village.update',$row->id))->method('PUT')->id('my_form')}}
<?php
echo FormPanel2::make(
    'General',
    Former::text('id', 'ID',$row->id)->required() . ''
    .Former::text('kh_name', 'Kh Name',$row->kh_name)->required() . ''
    .Former::text('en_name', 'En Name',$row->en_name)->required() . ''
    ,Former::select('cp_location_id', 'Commune', \GetLists::getLocation(3),$row->cp_location_id)
        ->placeholder('- Select One -')

        ->required() . ''

);

?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>

{{Former::close()}}

@stop