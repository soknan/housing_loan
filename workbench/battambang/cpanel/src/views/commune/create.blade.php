@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

    {{Former::open( route('cpanel.commune.store'))->method('POST')->id('my_form')}}
    <?php
    echo FormPanel2::make(
            'General',
            Former::select('cp_location_id', 'District', \GetLists::getLocation(2))
                    ->placeholder('- Select One -')
                    ->class('select2')
                    ->required() . ''
            . Former::text('id', 'ID')->required()->placeholder('6 Digits and number only')->pattern('\d{6}') . ''
            ,
            Former::text('kh_name', 'Kh Name')->required() . ''
            . Former::text('en_name', 'En Name')->required() . ''
    );

    ?>

    <div class="text-center">
        {{ Former::lg_primary_submit('Submit') . '&nbsp;' . Former::lg_inverse_reset('Reset') }}
    </div>

    {{Former::close()}}

@stop


