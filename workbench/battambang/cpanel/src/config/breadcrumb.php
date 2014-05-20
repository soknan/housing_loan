<?php

return array(
    // For add new, edit

    'show' => array(
        'icon' => 'glyphicon glyphicon-eye-open',
        'label' => 'Show',
        'url' => ''
    ),
    'create' => array(
        'icon' => 'glyphicon glyphicon-plus',
        'label' => 'Add New',
        'url' => ''
    ),
    'add' => array(
        'icon' => '',
        'label' => 'Next',
        'url' => ''
    ),
    'edit' => array(
        'icon' => 'glyphicon glyphicon-edit',
        'label' => 'Edit',
        'url' => ''
    ),
    'report' => array(
        'icon' => 'glyphicon glyphicon-book',
        'label' => 'Reports',
        'url' => ''
    ),

    'changepwd' => array(
        'icon' => 'glyphicon glyphicon-pencil',
        'label' => 'Change Password',
        'url' => ''
    ),

    // For page
    'login' => array(
        'icon' => 'glyphicon glyphicon-log-in',
        'label' => 'Log In',
        'url' => route('cpanel.login')
    ),
    'home' => array(
        'icon' => 'glyphicon glyphicon-home',
        'label' => 'Home',
        'url' => route('cpanel.package.home')
    ),
    'package' => array(
        'icon' => 'glyphicon glyphicon-th-large',
        'label' => 'Package',
        'url' => route('cpanel.package')
    ),
    'group' => array(
        'icon' => 'glyphicon glyphicon-list',
        'label' => 'Group',
        'url' => route('cpanel.group.index')
    ),
    'user' => array(
        'icon' => 'glyphicon glyphicon-user',
        'label' => 'User',
        'url' => route('cpanel.user.index')
    ),

    'company' => array(
        'icon' => 'glyphicon glyphicon-stats',
        'label' => 'Company',
        'url' => route('cpanel.company.edit',1)
    ),

    'office' => array(
        'icon' => 'glyphicon glyphicon-tower',
        'label' => 'Office',
        'url' => route('cpanel.office.index')
    ),
    'workday' => array(
        'icon' => 'glyphicon glyphicon-briefcase',
        'label' => 'Working Day',
        'url' => route('cpanel.workday.index')
    ),
    'decode' => array(
        'icon' => 'glyphicon glyphicon-barcode',
        'label' => 'Decode',
        'url' => route('cpanel.decode.index')
    ),

    /*'permissions' => array(
        'icon' => 'icon-upload',
        'label' => 'Permissions',
        'url' => route('cpanel.permissions.index')
    ),

    'backup' => array(
        'icon' => 'icon-upload',
        'label' => 'Backup',
        'url' => ''
    ),

    'restore' => array(
        'icon' => 'icon-download',
        'label' => 'Restore',
        'url' => ''
    ),

    'decode' => array(
        'icon' => '',
        'label' => 'Decode Text',
        'url' => ''
    ),*/

);
