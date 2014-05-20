@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.staff.update',$row->id))->method('PUT')->enctype('multipart/form-data')}}

<?php
echo FormPanel2::make(
    'General',
    Former::text('en_first_name', 'En First Name', $row->en_first_name)->required() . ''
    . Former::text('en_last_name', 'En Last Name', $row->en_last_name)->required()
    . Former::text('kh_first_name', 'Kh First Name', $row->kh_first_name)->required()
    . Former::text('kh_last_name', 'Kh Last Name', $row->kh_last_name)->required()
    . Former::text('dob', 'DOB', Carbon::createFromFormat('Y-m-d',$row->dob)->format('d-m-Y'))->required()->append('dd-mm-yyyy')
    . Former::select('ln_lv_gender', 'Gender', \LookupValueList::getBy('gender'), $row->ln_lv_gender)->required()->placeholder('- Select One -')
    ,
    Former::select('ln_lv_marital_status', 'Status', \LookupValueList::getBy('marital status'), $row->ln_lv_marital_status)->required()->placeholder('- Select One -') . ''
    . Former::select('ln_lv_education', 'Education', \LookupValueList::getBy('education'), $row->ln_lv_education)->required()->placeholder('- Select One -')
    . Former::textarea('education_des', 'Education Des', $row->education_des)
    . Former::select('ln_lv_title', 'Position', \LookupValueList::getBy('title'), $row->ln_lv_title)->required()->placeholder('- Select One -')
    . Former::text('joining_date', 'Join Date', Carbon::createFromFormat('Y-m-d',$row->joining_date)->format('d-m-Y'))->required()->append('dd-mm-yyyy')
);

echo FormPanel2::make(
    'ID Type',
    Former::select('ln_lv_id_type', 'ID Type', \LookupValueList::getBy('id type'), $row->ln_lv_id_type)->required()->placeholder('- Select One -') . ''
    . Former::text('id_num', 'ID Number', $row->id_num)
    ,
    Former::text('expire_date', 'Expire Date', $row->expire_date=='0000-00-00'?$row->expire_date="":date('d-m-Y',strtotime($row->expire_date)))
        ->append('dd-mm-yyyy') . ''
);

echo FormPanel2::make(
    'Contact',
    Former::textarea('address', 'Address', $row->address)->required() . ''
    . Former::text('telephone', 'Telephone', $row->telephone)->required()
    . Former::text('email', 'Email', $row->email)
    ,
    Former::select('cp_office_id', 'Branch Office')
        ->options(\GetLists::getSubBranchList(), $row->cp_office_id)
        ->required()
        ->placeholder('- Select One -') . ''
    . Former::file('attach_photo', 'Photo') . ''
    . '<div class="text-center"><img src="' . $row->attach_photo . '" width="100px" height="100px"/></div>'.''
);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop
@section('js')
<?php
echo DatePicker::make('dob');
echo DatePicker::make('joining_date');
echo DatePicker::make('expire_date');
?>
@stop
