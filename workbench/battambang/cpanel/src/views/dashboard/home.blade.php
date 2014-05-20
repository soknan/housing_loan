@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{ Former::open(URL::current())->method('post')->id('my_form') }}

<!--        <div class="margin-top-20">-->
<!--            @if ( Session::has('login_success') )-->
<!--            <div class="alert-login alert-success">-->
<!--                <strong>{{ Session::get('login_success') }}</strong>-->
<!--            </div>-->
<!--            @endif-->
<!--            @if ( Session::has('login_error') )-->
<!--            <div class="alert-login alert-error">-->
<!--                <strong>{{ Session::get('login_error') }}</strong>-->
<!--            </div>-->
<!--            @endif-->
<!--        </div>-->
<?php
echo FormPanel2::make(
    'General',
    Former::select('user_group', 'Group Name', GetLists::userGroup())
        ->placeholder('- Select One -')
        ->required() . ''
//    Former::select('package', 'Package Type', GetLists::getPackageList())->placeholder('- Select One -')->required() . ''
//    . Former::select('branch', 'Branch Office')->required()
    ,
    Former::select('branch_office', 'Branch Office')
        ->placeholder('- Select One -')
        ->required() . ''
);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Go...')->name('go') }}
</div>

{{ Former::close()}}

@stop

@section('js')
<?php
echo FormerAjax::make('my_form', 'user_group', 'change', URL::to('cpanel/package/group_change'))
    ->getChange(array('branch_office' => 'html(data.branch_office)'));
//echo FormerAjax::make('my_form', 'branch', 'change', URL::to('cpanel/package/branch_change'))
//    ->getChange(array('sub_branch' => 'html(data.sub_branch)'));
echo FormerAjax::make('my_form', 'go', 'click', URL::to('cpanel/package'))
    ->getGo('alert', 'html(data.alert)', URL::route('cpanel.package.home'));
?>
@stop