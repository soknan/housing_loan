<?php

Menu::create(
    'home',
    function ($menu) {
        $menu->add(
            [
                'title' => 'Home',
                'url' => route('cpanel.package.home')
            ]
        );
    }
);
Menu::create(
    'cpanel',
    function ($menu) {

        // Manage Data
        $menu->add(
            [
                'title' => 'Manage Data',
                'url' => '#',
//                'icon' => 'fa fa-user'
            ]
        )
            ->child(
                [
                    'title' => 'Groups',
                    'url' => route('cpanel.group.index')
                ]
            )->child(
                [
                    'title' => 'Users',
                    'url' => route('cpanel.user.index')
                ]
            );

        // Setting
        $menu->add(
            [
                'title' => 'Setting',
                'url' => '#',
//                'icon' => 'fa fa-user'
            ]
        )
            ->child(
                [
                    'title' => 'Company',
                    'url' => route('cpanel.company.edit', 1)
                ]
            )
            ->child(
                [
                    'title' => 'Office',
                    'url' => route('cpanel.office.index')
                ]
            )->child(
                [
                    'title' => 'Work Day',
                    'url' => route('cpanel.workday.index')
                ]
            )->child(
                [
                    'title' => 'Decode Text',
                    'url' => route('cpanel.decode.index')
                ]
            );
    }
);