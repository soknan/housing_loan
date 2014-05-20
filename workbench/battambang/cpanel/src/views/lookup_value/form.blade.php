@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

<?php
echo Former::open($form_action)->method($form_method);
echo FormPanel2::make(
    'General',
    Former::text('code', 'Code', $form->code)
        ->required() . ''
    . Former::text('name', 'Name', $form->name)
        ->required()
    ,
    Former::select('cp_lookup_id', 'Lookup ID')
        ->options(GetLists::lookup(), $form->cp_lookup_id)
        ->required()
        ->placeholder('- Select One -') . ''
);
?>

<div class="text-center">
    {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
</div>
{{Former::close()}}

@stop