@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.staff.store'))->method('POST')->enctype('multipart/form-data')}}

<?php
echo FormPanel2::make(
    'General',
     Former::text('kh_first_name', 'Kh First Name')->required()
    . Former::text('kh_last_name', 'Kh Last Name')->required()
     .Former::text('en_first_name', 'En First Name')->required() . ''
     . Former::text('en_last_name', 'En Last Name')->required()
    . Former::text('dob', 'DOB')->required()->append('dd-mm-yyyy')
    . Former::select('ln_lv_gender', 'Gender', \LookupValueList::getBy('gender'))->required()->placeholder('- Select One -')
    ,
    Former::select('ln_lv_marital_status', 'Status', \LookupValueList::getBy('marital status'))->required()->placeholder('- Select One -') . ''
    . Former::select('ln_lv_education', 'Education', \LookupValueList::getBy('education'))->required()->placeholder('- Select One -')
    . Former::textarea('education_des', 'Education Des')
    . Former::select('ln_lv_title', 'Position', \LookupValueList::getBy('title'))->required()->placeholder('- Select One -')
    . Former::text('joining_date', 'Join Date')->required()->append('dd-mm-yyyy')
);

echo FormPanel2::make(
    'ID Type',
    Former::select('ln_lv_id_type', 'ID Type', \LookupValueList::getBy('id type'))->required()->placeholder('- Select One -') . ''
    . Former::text('id_num', 'ID Number')
    ,
    Former::text('expire_date', 'Expire Date')->append('dd-mm-yyyy') . ''
);

echo FormPanel2::make(
    'Contact',
    Former::textarea('address', 'Address')->required() . ''
    . Former::text('telephone', 'Telephone')->required()
    ,
    Former::text('email', 'Email')
    .Former::hidden('cp_office_id', UserSession::read()->sub_branch)
//    Former::select('cp_office_id', 'Branch Office')
//        ->options(\GetLists::getSubBranchList())
//        ->required()
//        ->placeholder('- Select One -') . ''
    . Former::file('attach_photo', 'Photo') . ''
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
