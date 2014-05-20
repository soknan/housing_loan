@extends(Config::get('theara/cpanel::views.layout'))
@section('header')

@stop
@section('help')
<p class="lead">Report</p>
<p>
    From here you can create, edit or delete users. Also you can assign custom permissions to a single user.
</p>
@stop
@section('content')

<div class="row-fluid">
    <div class="span12">
        {{Former::horizontal_open(route('cpanel.users.report'))->method('POST')}}
        <div class="block">
            <p class="block-heading">User</p>

            <div class="block-body">
                <div class="btn-toolbar">
                    <a href="{{ route('cpanel.users.index') }}" class="btn btn-primary" rel="tooltip" title="Back">
                        <i class="icon-arrow-left"></i>
                        Back
                    </a>
                </div>

                <div class="row-fluid">
                    <div class="span6">
                        {{ Former::span12_date('from_date', 'From')->required() }}
                        {{ Former::span12_date('to_date', 'To')->required() }}
                    </div>
                </div>

                <div class="form-actions">
                    <input type="submit" name="save_new" value="Submit" class="btn btn-primary"/>

                    <button class="btn" type="reset">Reset</button>

                </div>

            </div>
        </div>

        {{Former::close()}}

    </div>
</div>
@stop
