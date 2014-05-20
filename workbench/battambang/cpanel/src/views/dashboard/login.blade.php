@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{ Former::open(route('cpanel.login'))->class('form-signin')->method('POST') }}

@if ( Session::has('login_error') )
<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ Session::get('login_error') }}
</div>
@endif

@if ( Session::has('logout') )
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ Session::get('logout') }}
</div>
@endif

<h2 class="form-signin-heading">Please Log In</h2>
<input type="text" name="username" class="form-control" placeholder="User Name" required autofocus="">
<input type="password" name="password" class="form-control" placeholder="Password" required>
<button class="btn btn-lg btn-primary btn-block" type="submit">Log In</button>

{{ Former::close() }}


@stop
