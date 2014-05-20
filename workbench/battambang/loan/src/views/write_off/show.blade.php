@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')
<div class="row">
    <table class="table table-striped">
        <tbody>
        <tr>
            <td>
                <strong>
                    Officecode
                </strong></td>
            <td>{{$row->id}}</td>
        </tr>
        <tr>
            <td><strong>
                    Office Name (Kh)
                </strong></td>
            <td>{{$row->kh_name}}</td>
        </tr>
        <tr>
            <td><strong>
                    Office Name (En)
                </strong></td>
            <td>{{$row->en_name}}</td>
        </tr>
        <tr>
            <td><strong>
                    Register Date
                </strong></td>
            <td>{{$row->register_at}}</td>
        </tr>

        <tr>
            <td><strong>
                    Address (Kh)
                </strong></td>
            <td>{{$row->kh_address}}</td>
        </tr>
        <tr>
            <td><strong>
                    Address (En)
                </strong></td>
            <td>{{$row->en_address}}</td>
        </tr>
        <tr>
            <td><strong>
                    Telephone
                </strong></td>
            <td>{{$row->telephone}}</td>
        </tr>
        <tr>
            <td><strong>
                    Email
                </strong></td>
            <td>{{$row->email}}</td>
        </tr>
        </tbody>
    </table>

</div>
@stop
