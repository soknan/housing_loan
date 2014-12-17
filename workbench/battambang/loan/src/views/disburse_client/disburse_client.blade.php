@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <dl class="dl-horizontal">
        <dt>Center Info :</dt>
        <dd>{{ $dis->center_name.', '.$dis->staff_en_name }}</dd>
        <dt>Product Info :</dt>
        <dd>{{ $pro->product_name }}</dd>

    </dl>
</div>
<?php
    if($dis->disburse_date != date('Y-m-d')){
        echo '<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <dl class="dl-horizontal">
        Warning : Now your disburse Date ('.date('d-M-Y',strtotime($dis->disburse_date)).') not equal with Current Date ('.date('d-M-Y').') !.
    </dl>
</div>';
    }
?>
{{Former::open(route('loan.disburse_client.create',$disburse_id))->method('GET')}}

<?php
echo FormPanel2::make(
    'Disburse Client',
    Former::text('ln_disburse_id', 'Disburse ID', $disburse_id)
        ->readonly('readonly')
        ->required() . ''
    ,
    Former::select('ln_client_id', 'Client')->required()
        ->options($client)
        ->class('select2')
        ->required()
        ->placeholder('- Select One -') . ''
);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Next') }}
</div>
{{Former::close()}}

@stop
<!--@section('js')
<?php
/*echo Select2::make('ln_client_id', URL::route('loan.client.ajax',$disburse_id),$minimumInputLength =0, $placeholder =' Search By ID , Name..' );
*/?>
@stop-->
