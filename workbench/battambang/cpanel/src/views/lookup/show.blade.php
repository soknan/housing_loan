@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')
<dl class="dl-horizontal">
    <dt>ID</dt>
    <dd>{{$show->id}}</dd>
    <dt>Lookup Code</dt>
    <dd>{{$show->code}}</dd>
    <dt>Name</dt>
    <dd>{{$show->name}}</dd>
    <dt>Type</dt>
    <dd>{{$show->type}}</dd>
</dl>
@stop
