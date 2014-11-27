<?php

Menu::make(
    'home',
    function ($menu) {
        $menu->add('Home', route('cpanel.package.home'));
    }
);

Menu::make(
    'cpanel',
    function ($menu) {
        // Manage Data
        $menu->add(
            'Manage Data',
            function ($dropdown) {
                $dropdown->add('Groups', route('cpanel.group.index'));
                $dropdown->add('Users', route('cpanel.user.index'));
            }
        );

        // Setting
        $menu->add(
            'Setting',
            function ($dropdown) {
                $dropdown->add('Company', route('cpanel.company.edit', 1));
                $dropdown->add('Office', route('cpanel.office.index'));
                $dropdown->add('Work Day', route('cpanel.workday.index'));
                $dropdown->add('Decode Text', route('cpanel.decode.index'));
                $dropdown->add(
                    'Location',
                    function ($dropdown) {
                $dropdown->add('Province', route('cpanel.province.index'));
                $dropdown->add('District', route('cpanel.district.index'));
                $dropdown->add('Commune', route('cpanel.commune.index'));
                $dropdown->add('Village', route('cpanel.village.index'));
                    });
            }
        );
    }
);