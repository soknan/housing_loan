@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.fee.store'))->method('POST')}}

<?php
echo FormPanel2::make(
    'General',
    Former::text('name', 'name')->required() . ''
    .Former::select('ln_lv_fee_type', 'Fee Type')
    ->options(\LookupValueList::getBy('fee type',' and ln_lookup_value.code = "LD"'))

        ->required()
    .Former::select('ln_lv_calculate_type', 'Calculate Type')
    ->options(\LookupValueList::getBy('fee calculate type'))

        ->required()

    ,
    Former::number('amount', 'Amount')->min(0)->step(0.01)->required(). ''
    .Former::select('ln_lv_percentage_of', 'Percentage Of')
    ->options(LookupValueList::getBy('fee percentage of','and ln_lookup_value.code = "LA" '))

        ->required()


);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop
