@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open(route('loan.disburse.create'))}}
<?php
echo FormPanel2::make(
    'General',
//    Former::text('ln_center_id', 'Center')->required()
    Former::select('ln_center_id', 'Center')
        ->options(LookupValueList::getCenter())
        ->class('select2')
        ->required()
        ->placeholder('- Select One -') . ''
    ,
//    Former::text('ln_product_id', 'Product')->required()
    Former::select('ln_product_id', 'Product')
        ->options(LookupValueList::getProduct())
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
@section('js')
<?php
//    echo Select2::make('ln_center_id', URL::route('loan.center.ajax'),$minimumInputLength = 2, $placeholder = 'Search By ID , Name');
//    echo Select2::make('ln_product_id', URL::route('loan.product.ajax'),$minimumInputLength = 2, $placeholder = 'Search By ID , Name');
?>
@stop

