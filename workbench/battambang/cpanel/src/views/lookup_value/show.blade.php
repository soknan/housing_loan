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
    <dd>{{$show->cp_lookup_id}}</dd>
</dl>
@stop
