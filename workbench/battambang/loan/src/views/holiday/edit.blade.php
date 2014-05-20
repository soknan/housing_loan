@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.holiday.update',$row->id))->method('PUT')->enctype('multipart/form-data')}}

<?php
echo FormPanel2::make(
    'General',
    Former::text('name', 'Name',$row->name)->required() . ''
    /*.Former::date('holiday_from', 'Date From')
        ->append('dd/mm/yyyy')
        ->required()*/
    ,
    Former::text('holiday_date', 'Date',Carbon::createFromFormat('Y-m-d',$row->holiday_date)->format('d-m-Y'))
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
