@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.write_off_rule.store'))->method('POST')->enctype('multipart/form-data')}}

<?php
echo FormPanel2::make(
    'General',
    Former::number('num_day', 'num_day')->required() . ''
    ,
    Former::text('activated_at', 'activated_at',date('d-m-Y'))
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
