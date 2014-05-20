@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.exchange.update',$row->id))->method('PUT')}}

<?php
echo FormPanel2::make(
    'General',
    Former::text('exchange_at', 'Exchange Date', Carbon::createFromFormat('Y-m-d',$row->exchange_at)->format('d-m-Y'))
        ->append('dd-mm-yyyy')
        ->required() . ''
    .Former::number('khr_usd', 'khr_usd',$row->khr_usd)->required()
    .Former::number('usd', 'usd',$row->usd)->required()

    ,
    Former::number('khr_thb', 'khr_thb',$row->khr_thb)->required(). ''
    .Former::number('thb', 'thb',$row->thb)->required()
    .Former::textarea('des', 'des',$row->des)->required()


);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop
@section('js')
<?php
echo DatePicker::make('exchange_at');
?>
@stop
