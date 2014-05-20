@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.holiday.store'))->method('POST')->enctype('multipart/form-data')}}

<?php
echo FormPanel2::make(
    'General',
    Former::text('name', 'Name')->required() . ''

    ,
    Former::text('holiday_date', 'Date')
    ->append('dd-mm-yyyy')
        ->required(). ''

);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop
@section('js')
<?php
echo DatePicker::make('holiday_date');
?>
@stop
