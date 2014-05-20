@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.penalty_closing.update',$row->id))->method('PUT')}}

<?php
echo FormPanel2::make(
    'General',
    Former::text('name', 'name',$row->name)->required() . ''
    .Former::text('percentage_installment', 'Installment',$row->percentage_installment)
        ->append('%')->required()
    ,Former::text('percentage_interest_remainder', 'Interest Remainder',$row->percentage_interest_remainder)
        ->append('%')->required()


);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop
