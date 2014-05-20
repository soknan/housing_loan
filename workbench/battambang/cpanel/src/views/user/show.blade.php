@extends(Config::get('theara/cpanel::views.layout'))

@section('header')

@stop
@section('help')
    <p class="lead">Users</p>
    <p>
        From here you can create, edit or delete users. Also you can assign custom permissions to a single user.
    </p>
@stop
@section('content')
    <div class="row">
        <div class="span12">

            <div class="block">
                <p class="block-heading">{{ $user->user_name }} Profile</p>

                <div class="block-body">

                    <div class="btn-toolbar">
                        <a href="{{ route('cpanel.users.index') }}" class="btn btn-primary" rel="tooltip" title="Back">
                            <i class="icon-arrow-left"></i>
                            Back
                        </a>
                    </div>

                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td><strong>User Code</strong></td>
                                <td>{{ $user->user_code }}</td>
                            </tr>
                            <tr>
                                <td><strong>User Name</strong></td>
                                <td>{{ $user->user_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>{{ $user->user_status }}</td>
                            </tr>
                            <tr>
                                <td><strong>Date</strong></td>
                                <td>
                                    {{$user->in_date}}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Expire Days</strong></td>
                                <td>{{ $user->expire_days}}</td>
                            </tr>
                            <tr>
                                <td><strong>Owner</strong></td>
                                <td>{{ $user->owner_code }}</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
@stop
