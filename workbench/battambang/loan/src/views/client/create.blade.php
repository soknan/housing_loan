@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open( route('loan.client.store'))->method('POST')->enctype('multipart/form-data')}}

<?php
echo FormPanel2::make(
    'General',
    Former::text('en_first_name', 'En First Name')->required() . ''
    . Former::text('en_last_name', 'En Last Name')->required()
    . Former::text('en_nick_name', 'En Nick Name')
    . Former::text('kh_first_name', 'Kh First Name')->required()
    . Former::text('kh_last_name', 'Kh Last Name')->required()
    . Former::text('kh_nick_name', 'Kh Nick Name')
    ,
    Former::select('ln_lv_gender', 'Gender', \LookupValueList::getBy('gender'))->required()->placeholder('- Select One -') . ''
    . Former::text('dob', 'DOB')->required()->append('mm/dd/yyyy')
    . Former::textarea('place_birth', 'POB')
    . Former::select('ln_lv_nationality', 'Nationality', \LookupValueList::getBy('nationality'))->required()->placeholder('- Select One -')
    .Former::select('cp_office_id', 'Branch Office', \GetLists::getSubBranchListNoAjax(),UserSession::read()->sub_branch)
        ->required()
        ->placeholder('- Select One -') . ''
    . Former::file('attach_photo', 'Photo').''

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

