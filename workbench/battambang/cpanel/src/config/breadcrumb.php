<?php

$iconList = 'glyphicon glyphicon-list'; // for all breadcrumb
$iconAdd = 'glyphicon glyphicon-plus'; // for all breadcrumb
$iconEdit = 'glyphicon glyphicon-edit'; // for all breadcrumb
$iconShow = 'glyphicon glyphicon-eye-open'; // for all breadcrumb
$iconReport = 'glyphicon glyphicon-list-alt'; // for all breadcrumb
$iconUpload = 'glyphicon glyphicon-upload'; // for all breadcrumb
$iconDownload = 'glyphicon glyphicon-download'; // for all breadcrumb
$iconBackup = 'glyphicon glyphicon-cloud-download'; // for all breadcrumb
$iconRestore = 'glyphicon glyphicon-cloud-upload'; // for all breadcrumb

return array(
    // For add new, edit

    'show' => array(
        'icon' => $iconShow,
        'label' => 'Show',
        'url' => ''
    ),
    'create' => array(
        'icon' => $iconAdd,
        'label' => 'Add New',
        'url' => ''
    ),
    'add' => array(
        'icon' => '',
        'label' => 'Next',
        'url' => ''
    ),
    'edit' => array(
        'icon' => $iconEdit,
        'label' => 'Edit',
        'url' => ''
    ),
    'report' => array(
        'icon' => $iconReport,
        'label' => 'Reports',
        'url' => ''
    ),
    'changepwd' => array(
        'icon' => $iconEdit,
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
        'icon' => 'glyphicon glyphicon-briefcase',
        'label' => 'Package',
        'url' => route('cpanel.package')
    ),
    'group' => array(
        'icon' => $iconList,
        'label' => 'Group',
        'url' => route('cpanel.group.index')
    ),
    'user' => array(
        'icon' => $iconList,
        'label' => 'User',
        'url' => route('cpanel.user.index')
    ),
    'company' => array(
        'icon' => $iconList,
        'label' => 'Company',
        'url' => route('cpanel.company.edit', 1)
    ),
    'office' => array(
        'icon' => $iconList,
        'label' => 'Office',
        'url' => route('cpanel.office.index')
    ),
    'workday' => array(
        'icon' => $iconList,
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
