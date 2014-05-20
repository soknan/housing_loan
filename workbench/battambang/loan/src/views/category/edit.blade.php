@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.category.update',$row->id))->method('PUT')}}

<?php
echo FormPanel2::make(
    'General',
    Former::text('name', 'name', $row->name)->required() . ''
    ,
    Former::textarea('des', 'Desc', $row->des)->required().''
);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop
