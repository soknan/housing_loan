@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')
{{Former::open(route('cpanel.user.update',$row->id))->method('PUT')}}

<?php
echo FormPanel2::make(
    'General',
//     Former::text_hidden('hidden_id',$row->id).''
    Former::text('first_name', 'First Name', $row->first_name)->required() . ''
    . Former::text('last_name', 'Last Name', $row->last_name)->required()
    . Former::text('email', 'Email', $row->email)->required()
    ,
    Former::text('username', 'User Name', $row->username)->required() . ''
    . Former::password('password', 'Password')
    . Former::password('password_confirmation', 'Confirm Password')

);

echo FormPanel2::make(
    'Permission',
    Former::text('expire_day', 'Expire Day', $row->expire_day)->required() . ''
    . Former::select('activated', 'Activated', GetLists::getActivatedList(), $row->activated)->placeholder('- Select One -')->required()
    . Former::text('activated_at', 'Activated Date')
        ->value(date('d-m-Y',strtotime($row->activated_at)))
        ->placeholder(' dd-mm-yyyy')
        ->append('<span class="glyphicon glyphicon-calendar"></span>'). ''
    ,
    Former::select('group[]', 'Group')
        ->options(GetLists::getGroupList(), json_decode($row->cp_group_id_arr, true))
        ->multiple()
        ->required().''
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
