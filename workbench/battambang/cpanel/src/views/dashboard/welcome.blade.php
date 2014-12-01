@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')
<dl class="dl-horizontal">
    <dt>User Gruop</dt>
    <dd>
        <?php
        echo UserSession::read()->group_name;
        ?>
    </dd>
    <dt>Package</dt>
    <dd>
        <?php
        echo ucfirst(UserSession::read()->package);
        ?>
    </dd>
    <dt>Branch Office</dt>
    <dd>
        <?php
        echo UserSession::read()->branch.':'.\Battambang\Cpanel\Office::find(UserSession::read()->branch)->en_name;
        echo ' | ';
        echo UserSession::read()->sub_branch.':'.\Battambang\Cpanel\Office::find(UserSession::read()->sub_branch)->en_name;
        ?>
    </dd>
    <dt>Permission</dt>
    <dd>
        <?php
        $comma = '';
        foreach(UserSession::read()->permission as $value) {
            echo $comma . $value;
            $comma = ', ';
        }
        ?>
    </dd>
</dl>
@stop
