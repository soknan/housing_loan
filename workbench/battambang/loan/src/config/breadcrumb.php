<?php

return array(
    'dashboard' => array(
        'icon' => '',
        'label' => 'Dashboard',
        'url' => route('loan.dashboard.index')
    ),
    'lookup' => array(
        'icon' => '',
        'label' => 'Lookup',
        'url' => route('loan.lookup.index')
    ),
    'lookup_value' => array(
        'icon' => '',
        'label' => 'Lookup Value',
        'url' => route('loan.lookup_value.index')
    ),
    'write_off' => array(
        'icon' => '',
        'label' => 'Write-Off ',
        'url' => route('loan.write_off.index')
    ),
    'penalty_closing' => array(
        'icon' => '',
        'label' => 'Penalty Closing',
        'url' => route('loan.penalty_closing.index')
    ),
    'penalty' => array(
        'icon' => '',
        'label' => 'Penalty',
        'url' => route('loan.penalty.index')
    ),
    'fee' => array(
        'icon' => '',
        'label' => 'Fee',
        'url' => route('loan.fee.index')
    ),
    'exchange' => array(
        'icon' => '',
        'label' => 'Exchange',
        'url' => route('loan.exchange.index')
    ),
    'holiday' => array(
        'icon' => '',
        'label' => 'Holiday',
        'url' => route('loan.holiday.index')
    ),
    'fund' => array(
        'icon' => '',
        'label' => 'Fund',
        'url' => route('loan.fund.index')
    ),
    'client' => array(
        'icon' => 'glyphicon glyphicon-user',
        'label' => 'Client',
        'url' => route('loan.client.index')
    ),

    'center' => array(
        'icon' => '',
        'label' => 'Center',
        'url' => route('loan.center.index')
    ),
    'category' => array(
        'icon' => '',
        'label' => 'Category',
        'url' => route('loan.category.index')
    ),
    'staff' => array(
        'icon' => '',
        'label' => 'Staff',
        'url' => route('loan.staff.index')
    ),

    'product' => array(
        'icon' => '',
        'label' => 'Product',
        'url' => route('loan.product.index')
    ),
    'disburse' => array(
        'icon' => '',
        'label' => 'Disbursement',
        'url' => route('loan.disburse.index')
    ),
    'disburse_client' => array(
        'icon' => '',
        'label' => 'Disbursement Client',
        'url' => route('loan.disburse_client.index',(Route::currentRouteName() == 'loan.disburse_client.create' or Route::currentRouteName() == 'loan.disburse_client.add') ? Request::segment(4) : Request::segment(5))
    ),

    'repayment' => array(
        'icon' => '',
        'label' => 'Repayment',
        'url' => route('loan.repayment.index')
    ),

    'rpt_schedule' => array(
        'icon' => '',
        'label' => 'Repayment Schedule Report',
        'url' => route('loan.rpt_schedule.report')
    ),
    'rpt_disburse_client' => array(
        'icon' => '',
        'label' => 'Loan Disbursement Report',
        'url' => route('loan.rpt_schedule.report')
    ),
    'rpt_loan_out' => array(
        'icon' => '',
        'label' => 'Loan Outstanding Report',
        'url' => route('loan.rpt_loan_out.report')
    ),
    'rpt_loan_repay' => array(
        'icon' => '',
        'label' => 'Loan Repay Report',
        'url' => route('loan.rpt_loan_repay.report')
    ),
    'rpt_loan_finish' => array(
        'icon' => '',
        'label' => 'Loan Closing Report',
        'url' => route('loan.rpt_loan_finish.report')
    ),
    'rpt_collection_sheet' => array(
        'icon' => '',
        'label' => 'Collection Sheet Report',
        'url' => route('loan.rpt_collection_sheet.report')
    ),
    'rpt_loan_history' => array(
        'icon' => '',
        'label' => 'Loan History Report',
        'url' => route('loan.rpt_loan_history.report')
    ),
    'rpt_write_off_in' => array(
        'icon' => '',
        'label' => 'Write-Off (In Period) Report',
        'url' => route('loan.rpt_write_off_in.report')
    ),
    'rpt_write_off_end' => array(
        'icon' => '',
        'label' => 'Write-Off (End Period) Report',
        'url' => route('loan.rpt_write_off_end.report')
    ),
    'rpt_breakdown_purpose' => array(
        'icon' => '',
        'label' => 'Loan BreakDown By Purpose',
        'url' => route('loan.rpt_loan_history.report')
    ),
    'rpt_breakdown_currency' => array(
        'icon' => '',
        'label' => 'Loan BreakDown By Currency',
        'url' => route('loan.rpt_loan_history.report')
    ),
    'rpt_nbc_7' => array(
        'icon' => '',
        'label' => 'Loan Classification, Provisioning and Delinquency Ratio',
        'url' => route('loan.rpt_loan_history.report')
    ),
    'rpt_nbc_11' => array(
        'icon' => '',
        'label' => 'Network Information',
        'url' => route('loan.rpt_loan_history.report')
    ),
    'attach_file' => array(
        'icon' => '',
        'label' => 'Attach Files',
    ),
    'backup' => array(
        'icon' => '',
        'label' => 'Backup',
    ),
    'restore' => array(
        'icon' => '',
        'label' => 'Restore',
    ),

);
