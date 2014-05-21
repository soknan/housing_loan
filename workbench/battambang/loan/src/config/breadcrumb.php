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
    'dashboard' => array(
        'icon' => '',
        'label' => 'Dashboard',
        'url' => route('loan.dashboard.index')
    ),
    'lookup' => array(
        'icon' => $iconList,
        'label' => 'Lookup',
        'url' => route('loan.lookup.index')
    ),
    'lookup_value' => array(
        'icon' => $iconList,
        'label' => 'Lookup Value',
        'url' => route('loan.lookup_value.index')
    ),
    'write_off' => array(
        'icon' => $iconList,
        'label' => 'Write-Off ',
        'url' => route('loan.write_off.index')
    ),
    'penalty_closing' => array(
        'icon' => $iconList,
        'label' => 'Penalty Closing',
        'url' => route('loan.penalty_closing.index')
    ),
    'penalty' => array(
        'icon' => $iconList,
        'label' => 'Penalty',
        'url' => route('loan.penalty.index')
    ),
    'fee' => array(
        'icon' => $iconList,
        'label' => 'Fee',
        'url' => route('loan.fee.index')
    ),
    'exchange' => array(
        'icon' => $iconList,
        'label' => 'Exchange',
        'url' => route('loan.exchange.index')
    ),
    'holiday' => array(
        'icon' => $iconList,
        'label' => 'Holiday',
        'url' => route('loan.holiday.index')
    ),
    'fund' => array(
        'icon' => $iconList,
        'label' => 'Fund',
        'url' => route('loan.fund.index')
    ),
    'client' => array(
        'icon' => $iconList,
        'label' => 'Client',
        'url' => route('loan.client.index')
    ),

    'center' => array(
        'icon' => $iconList,
        'label' => 'Center',
        'url' => route('loan.center.index')
    ),
    'category' => array(
        'icon' => $iconList,
        'label' => 'Category',
        'url' => route('loan.category.index')
    ),
    'staff' => array(
        'icon' => $iconList,
        'label' => 'Staff',
        'url' => route('loan.staff.index')
    ),

    'product' => array(
        'icon' => $iconList,
        'label' => 'Product',
        'url' => route('loan.product.index')
    ),
    'disburse' => array(
        'icon' => $iconList,
        'label' => 'Disbursement',
        'url' => route('loan.disburse.index')
    ),
    'disburse_client' => array(
        'icon' => $iconList,
        'label' => 'Disbursement Client',
        'url' => route('loan.disburse_client.index',(Route::currentRouteName() == 'loan.disburse_client.create' or Route::currentRouteName() == 'loan.disburse_client.add') ? Request::segment(4) : Request::segment(5))
    ),

    'repayment' => array(
        'icon' => $iconList,
        'label' => 'Repayment',
        'url' => route('loan.repayment.index')
    ),

    'rpt_schedule' => array(
        'icon' => $iconReport,
        'label' => 'Repayment Schedule Report',
        'url' => route('loan.rpt_schedule.report')
    ),
    'rpt_disburse_client' => array(
        'icon' => $iconReport,
        'label' => 'Loan Disbursement Report',
        'url' => route('loan.rpt_schedule.report')
    ),
    'rpt_loan_out' => array(
        'icon' => $iconReport,
        'label' => 'Loan Outstanding Report',
        'url' => route('loan.rpt_loan_out.report')
    ),
    'rpt_loan_repay' => array(
        'icon' => $iconReport,
        'label' => 'Loan Repay Report',
        'url' => route('loan.rpt_loan_repay.report')
    ),
    'rpt_loan_finish' => array(
        'icon' => $iconReport,
        'label' => 'Loan Closing Report',
        'url' => route('loan.rpt_loan_finish.report')
    ),
    'rpt_collection_sheet' => array(
        'icon' => $iconReport,
        'label' => 'Collection Sheet Report',
        'url' => route('loan.rpt_collection_sheet.report')
    ),
    'rpt_loan_history' => array(
        'icon' => $iconReport,
        'label' => 'Loan History Report',
        'url' => route('loan.rpt_loan_history.report')
    ),
    'rpt_write_off_in' => array(
        'icon' => $iconReport,
        'label' => 'Write-Off (In Period) Report',
        'url' => route('loan.rpt_write_off_in.report')
    ),
    'rpt_write_off_end' => array(
        'icon' => $iconReport,
        'label' => 'Write-Off (End Period) Report',
        'url' => route('loan.rpt_write_off_end.report')
    ),
    'rpt_breakdown_purpose' => array(
        'icon' => $iconReport,
        'label' => 'Loan BreakDown By Purpose',
        'url' => route('loan.rpt_loan_history.report')
    ),
    'rpt_breakdown_currency' => array(
        'icon' => $iconReport,
        'label' => 'Loan BreakDown By Currency',
        'url' => route('loan.rpt_loan_history.report')
    ),
    'rpt_nbc_7' => array(
        'icon' => $iconReport,
        'label' => 'Loan Classification, Provisioning and Delinquency Ratio',
        'url' => route('loan.rpt_loan_history.report')
    ),
    'rpt_nbc_11' => array(
        'icon' => $iconReport,
        'label' => 'Network Information',
        'url' => route('loan.rpt_loan_history.report')
    ),
    'attach_file' => array(
        'icon' => $iconUpload,
        'label' => 'Attach Files',
    ),
    'backup' => array(
        'icon' => $iconBackup,
        'label' => 'Backup',
    ),
    'restore' => array(
        'icon' => $iconRestore,
        'label' => 'Restore',
    ),

);
