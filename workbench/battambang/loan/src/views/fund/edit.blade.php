@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.fund.update',$row->id))->method('PUT')}}

<?php
echo FormPanel2::make(
    'General',
    Former::text('name', 'Name',$row->name)->required() . ''
    .Former::text('code', 'Short Name',$row->code)->required()
    .Former::text('register_at', 'Register Date',Carbon::createFromFormat('Y-m-d',$row->register_at)->format('d-m-Y'))
        ->append('dd-mm-yyyy')
        ->required()
    .Former::textarea('address', 'Address',$row->address)->required()
    ,
    Former::text('telephone', 'Telephone',$row->telephone) . ''
    .Former::text('email', 'Email',$row->email)
    .Former::text('website', 'Website',$row->website)

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
