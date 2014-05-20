@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open(route('cpanel.changepwd.index'))->method('post')}}
@if(Auth::check()==false)
<a href="{{ route('cpanel.login')}}" class="btn btn-primary">Back</a>
@endif

<?php
echo FormPanel2::make(
    'General',
    Former::password('old_password', 'Old Password')->required() . ''
    . Former::password('password', 'New Password')->required()
    ,
    Former::password('password_confirmation', 'Confirm Password')->required() . ''
);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop
