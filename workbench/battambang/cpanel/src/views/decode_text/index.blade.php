@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{Former::open()}}
<?php
echo FormPanel2::make(
    'General',
    Former::textarea('decode_text', 'Decode Text')->required()
);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit')->name('submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop

@section('js')
<script>
    $(document).ready(function () {
        $('[name="submit"]').click(function () {
            $('[name="decode_text"]').val(decode64($('[name="decode_text"]').val()));
            return false;
        });
    });
</script>
@stop


