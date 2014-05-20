@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

<table width="720" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td>លេខកូដបញ្ចេញប្រាក់ </td>
                    <td>កាលបរិច្ឆេទនៃការខ្ចី </td>
                    <td>រយៈពេលខ្ចី </td>
                </tr>
                <tr>
                    <td>លេខកូដអត្តិថិជន </td>
                    <td>រូបិយប័ណ្ណ </td>
                    <td>សងរៀងរាល់ </td>
                </tr>
                <tr>
                    <td>ឈ្មោះ</td>
                    <td>ចំនួនទឹកប្រាក់</td>
                    <td>រំលោះដើមរៀងរាល់ ម្តង</td>
                </tr>
                <tr>
                    <td>ភេទ</td>
                    <td>ប្រភេទទុន</td>
                    <td>រលោះដើម %</td>
                </tr>
                <tr>
                    <td>ចំនួននៃការខ្ចី</td>
                    <td>លេខវិក្ក័យប័ត្រ</td>
                    <td>ប្រភេទនៃការគណនាការប្រាក់ :Declining</td>
                </tr>
                <tr>
                    <td>ភ្នាក់ងារ</td>
                    <td>អត្រាការប្រាក់</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3">អាសយដ្មាន</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table class="table table-bordered">
                <tr valign="middle">
                    <td>ល.រ</td>
                    <td>ថ្ងៃសងប្រាក់</td>
                    <td>ចំនួនថ្ងៃ</td>
                    <td>ប្រាក់ដើម</td>
                    <td>ប្រាក់ការ</td>
                    <td>ប្រាក់កំរ៉ៃ</td>
                    <td>សរុប</td>
                    <td>សមតុល្យប្រាក់ដើម</td>
                </tr>
                @foreach($result as $key=>$row)
                <?php $subTotal = $row->principal+$row->interest+$row->fee; ?>
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $row->due_date }}</td>
                    <td>{{ $row->num_day }}</td>
                    <td>{{ $row->principal }}</td>
                    <td>{{ $row->interest }}</td>
                    <td>{{ $row->fee }}</td>
                    <td>{{ $subTotal }}</td>
                    <td>{{ $row->balance }}</td>
                </tr>
                @endforeach
            </table>
        </td>
    </tr>
</table>
@stop

