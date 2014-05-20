@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.write_off_rule.update',$row->id))->method('PUT')}}

<?php
echo FormPanel2::make(
    'General',
    Former::number('num_day', 'num_day',$row->num_day)->required() . ''
    ,
    Former::text('activated_at', 'activated_at',Carbon::createFromFormat('Y-m-d',$row->activated_at)->format('d-m-Y'))
        ->append('dd-mm-yyyy')
        ->required() . ''
);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop
@section('js')
<?php
echo DatePicker::make('activated_at');
?>
@stop
