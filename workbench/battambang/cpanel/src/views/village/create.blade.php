@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

    {{Former::open( route('cpanel.village.store'))->method('POST')->id('my_form')}}
    <?php
    echo FormPanel2::make(
            'General',
            Former::select('cp_location_id', 'Commune', \GetLists::getLocation(3))
                    ->placeholder('- Select One -')->class('select2')
            . Former::text('id', 'ID')->required()->placeholder('8 Digits and number only')->pattern('\d{8}') . ''
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

