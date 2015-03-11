<?php

return array(
    'pre_paid' => array(
        'Add New' => route('loan.pre_paid.create'),
    ),
    'lookup' => array(
        'Add New' => route('loan.lookup.create'),
    ),
    'lookup_value' => array(
        'Add New' => route('loan.lookup_value.create'),
    ),
    'write_off' => array(
        'Add New' => route('loan.write_off.create'),
    ),
    'write_off_rule' => array(
        'Add New' => route('loan.write_off_rule.create'),
    ),
    'penalty_closing' => array(
        'Add New' => route('loan.penalty_closing.create'),
    ),
    'penalty' => array(
        'Add New' => route('loan.penalty.create'),
    ),
    'fee' => array(
        'Add New' => route('loan.fee.create'),
    ),
    'exchange' => array(
        'Add New' => route('loan.exchange.create'),
    ),
    'holiday' => array(
        'Add New' => route('loan.holiday.create'),
    ),
    'fund' => array(
        'Add New' => route('loan.fund.create'),
    ),
    'category' => array(
        'Add New' => route('loan.category.create'),
    ),
    'center' => array(
        'Add New' => route('loan.center.create'),
    ),
    'client' => array(
        'Add New' => route('loan.client.create'),
    ),
    'product' => array(
        'Add New' => route('loan.product.create'),
    ),
    'staff' => array(
        'Add New' => route('loan.staff.create'),
    ),
    'disburse' => array(
        'Add New' => route('loan.disburse.add'),
    ),
    'disburse_client' => array(
        'Add New' => route('loan.disburse_client.add',Request::segment(3)),
    ),
    'repayment' => array(
        'Add New' => route('loan.repayment.create'),
    ),

);