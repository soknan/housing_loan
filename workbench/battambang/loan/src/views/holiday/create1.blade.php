@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.holiday.store'))->method('POST')->enctype('multipart/form-data')}}

<?php
echo FormPanel2::make(
    'General',
    Former::text('name', 'Name')->required() . ''
    .Former::date('holiday_from', 'Date From')
        ->append('dd/mm/yyyy')
        ->required()
    ,
    Former::date('holiday_to', 'Date To')
    ->append('dd/mm/yyyy')
        ->required(). ''

);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop
