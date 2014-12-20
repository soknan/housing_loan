@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('cpanel.district.update',$row->id))->method('PUT')}}
<?php
echo FormPanel2::make(
    'General',
    Former::text('id', 'ID',$row->id)->required()->readonly(). ''
    .Former::text('kh_name', 'Kh Name',$row->kh_name)->required() . ''
    , Former::text('en_name', 'En Name',$row->en_name)->required() . ''
.Former::select('t_location_id', 'Province', \GetLists::getLocation(1),$row->cp_location_id)
        ->disabled()
        ->required() .Former::hidden('cp_location_id',$row->cp_location_id). ''


);

?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>

{{Former::close()}}

@stop
