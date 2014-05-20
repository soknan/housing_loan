<?php
return array(
    //menu 2 type are available single or dropdown and it must be a url
    'Manage Data' => array(
        'type' => 'dropdown', 
        'links' => array(
            'Groups' => array(
                'type' => 'single',
                'url' => route('cpanel.group.index')
            ),
            'Users' => array(
                'type' => 'single',
                'url' => route('cpanel.user.index')
            ),
        ),

    ),

    'Setting' => array(
        'type' => 'dropdown',
        'links' => array(
            'Company' => array(
                'type' => 'single',
                'url' => route('cpanel.company.edit',1)
            ),
            'Office' => array(
                'type' => 'single',
                'url' => route('cpanel.office.index')
            ),
            'Work Day' => array(
                'type' => 'single',
                'url' => route('cpanel.workday.index')
            ),
            'Decode Text' => array(
                'type' => 'single',
                'url' => route('cpanel.decode.index')
            ),
        ),
    )
);
