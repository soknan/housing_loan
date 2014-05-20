@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{ Former::open(route('loan.disburse.attach_update', $row->id))->method('PUT')->enctype('multipart/form-data') }}
<?php
echo FormPanel2::make(
    'General',
    Former::file('attach_file', 'Attach Files')
);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop

