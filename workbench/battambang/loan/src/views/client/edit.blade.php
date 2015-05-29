@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.client.update',$row->id))->method('PUT')->enctype('multipart/form-data')}}

<?php
echo FormPanel2::make(
    'General',
    Former::text('kh_first_name', 'Kh First Name', $row->kh_first_name)->required()
    . Former::text('kh_last_name', 'Kh Last Name', $row->kh_last_name)->required()
    . Former::text('kh_nick_name', 'Kh Nick Name', $row->kh_nick_name)
    .Former::text('en_first_name', 'En First Name', $row->en_first_name)->required() . ''
    . Former::text('en_last_name', 'En Last Name', $row->en_last_name)->required()
    . Former::text('en_nick_name', 'En Nick Name', $row->en_nick_name)
    ,
    Former::select('ln_lv_gender', 'Gender', \LookupValueList::getBy('gender'), $row->ln_lv_gender)->required() . ''
    . Former::text('dob', 'DOB', \Carbon::createFromFormat('Y-m-d',$row->dob)->format('d-m-Y'))->required()->append('dd-mm-yyyy')
    . Former::textarea('place_birth', 'POB', $row->place_birth)
    . Former::select('ln_lv_nationality', 'Nationality', \LookupValueList::getBy('nationality'), $row->ln_lv_nationality)->required()
    . Former::file('attach_photo', 'Photo')
    . '<div class="text-center"><img src="' . $row->attach_photo . '" width="100px" height="100px"/></div>'.''
    .Former::hidden('cp_office_id', \UserSession::read()->sub_branch)

);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop
@section('js')
<?php echo DatePicker::make('dob'); ?>
@stop
