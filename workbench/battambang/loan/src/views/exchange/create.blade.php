@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.exchange.store'))->method('POST')}}

<?php
echo FormPanel2::make(
    'General',
    Former::text('exchange_at', 'Exchange Date',date('d-m-Y'))
        ->append('dd-mm-yyyy')
        ->required() . ''
    .Former::number('khr_usd', 'khr_usd')->required()
    .Former::number('usd', 'usd')->required()

    ,
    Former::number('khr_thb', 'khr_thb')->required(). ''
    .Former::number('thb', 'thb')->required()
    .Former::textarea('des', 'des')->required()

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
