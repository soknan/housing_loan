@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')
{{Former::open(route('cpanel.user.store'))->method('POST')}}

<?php
echo FormPanel2::make(
    'General',
    Former::text_hidden('hidden_id', null) . ''
    . Former::text('first_name', 'First Name')->required()
    . Former::text('last_name', 'Last Name')->required()
    . Former::text('email', 'Email')->required()
    ,
    Former::text('username', 'User Name')->required() . ''
    . Former::password('password', 'Password')->required() . ''
    . Former::password('password_confirmation', 'Confirm Password')->required()

);

echo FormPanel2::make(
    'Permission',
    Former::text('expire_day', 'Expire Day')->required() . ''
    . Former::select('activated', 'Activated', GetLists::getActivatedList())
        ->placeholder('- Select One -')
        ->required() . ''
    . Former::text('activated_at', 'Activated Date')
        ->placeholder(' dd-mm-yyyy')
        ->append('<span class="glyphicon glyphicon-calendar"></span>') . ''
    ,
    Former::select('group[]', 'Group')
        ->options(GetLists::getGroupList())
        ->id('group')
        ->multiple()
        ->required() . ''
);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop

@section('js')
<?php echo DatePicker::make('activated_at'); ?>
@stop
