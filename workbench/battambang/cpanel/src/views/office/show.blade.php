@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')
<dl class="dl-horizontal">
    <dt>Office Code</dt>
    <dd>{{$row->id}}</dd>
    <dt>Office Name (Kh)</dt>
    <dd>{{$row->kh_name}}</dd>
    <dt>Office Name (En)</dt>
    <dd>{{$row->en_name}}</dd>
    <dt>Register Date</dt>
    <dd>{{$row->register_at}}</dd>
    <dt>Address (Kh)</dt>
    <dd>{{$row->kh_address}}</dd>
    <dt>Address (En)</dt>
    <dd>{{$row->en_address}}</dd>
    <dt>Telephone</dt>
    <dd>{{$row->telephone}}</dd>
    <dt>Email</dt>
    <dd>{{$row->email}}</dd>
</dl>
@stop
