<?php
return array(
    // Package or system type
    'cpanel' => array(
        'name' => 'CPanel System',
        'namespace' => 'battambang/cpanel',
        'author' => 'battambang',
        'url' => URL::to('cpanel'),
        'menu' => array(
            'company' => array(
                'cpanel.company.edit' => 'edit'
            ),
            'office' => array(
                'cpanel.office.index' => 'list',
                'cpanel.office.create' => 'create',
                'cpanel.office.edit' => 'edit',
                'cpanel.office.destroy' => 'delete'
            ),
            'work day' => array(
                'cpanel.workday.index' => 'list',
                'cpanel.workday.create' => 'create',
                'cpanel.workday.edit' => 'edit',
                'cpanel.workday.destroy' => 'delete'
            ),
            'decode' => array(
                'cpanel.decode.index' => 'create'
            ),
            'group' => array(
                'cpanel.group.index' => 'list',
                'cpanel.group.create' => 'create',
                'cpanel.group.edit' => 'edit',
                'cpanel.group.destroy' => 'delete',
            ),
            'user' => array(
                'cpanel.user.index' => 'list',
                'cpanel.user.create' => 'create',
                'cpanel.user.edit' => 'edit',
                'cpanel.user.destroy' => 'delete',
            ),
        )
    ),
    'loan' => array(
        'name' => 'Loan System',
        'namespace' => 'battambang/loan',
        'author' => 'loan',
        'url' => URL::to('loan'),
        'menu' => array(
            'client'=>array(
                'loan.client.index'=>'list',
                'loan.client.create'=>'create',
                'loan.client.edit'=>'edit',
                'loan.client.destroy'=>'delete',
            ),
        )
    ),
);