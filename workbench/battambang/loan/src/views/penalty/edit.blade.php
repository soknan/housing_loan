@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.penalty.update',$row->id))->method('PUT')}}

<?php
echo FormPanel2::make(
    'General',
    Former::text('name', 'name',$row->name)->required() . ''
    .Former::select('ln_lv_penalty_type', 'Penalty Type')
        ->options(\LookupValueList::getBy('penalty type',' limit 1'),$row->ln_lv_penalty_type)

        ->required()
    .Former::number('grace_period', 'grace_period',$row->grace_period)->required()
    .Former::select('ln_lv_calculate_type', 'Calculate Type')
        ->options(\LookupValueList::getBy('penalty calculate type'),$row->ln_lv_calculate_type)

        ->required()

    ,
    Former::number('amount', 'amount',$row->amount)->step(0.01)->min(0)->required(). ''
    .Former::select('ln_lv_percentage_of', 'Percentage Of')
        ->options(LookupValueList::getBy('penalty percentage of'),$row->ln_lv_percentage_of)
        
        ->required()


);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop
