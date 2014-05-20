@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.fund.store'))->method('POST')}}

<?php
echo FormPanel2::make(
    'General',
    Former::text('name', 'Name')->required() . ''
    .Former::text('code', 'Short Name')->required()
    .Former::text('register_at', 'Register Date')
        ->append('dd-mm-yyyy')
        ->required()
    .Former::textarea('address', 'Address')->required()
    ,
    Former::text('telephone', 'Telephone') . ''
    .Former::text('email', 'Email')
    .Former::text('website', 'Website')

);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop
@section('js')
<?php
echo DatePicker::make('register_at');
?>
@stop
