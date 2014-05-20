<?php
return array(
    // Package or system type
    'cpanel' => array(
        'name' => 'CPanel System',
        'namespace' => 'battambang/cpanel',
        'author' => 'battambang',
        'url' => URL::to('cpanel'),
        'menu'=> array('group','user','company','office','workday','decode')
    ),
    'loan' => array(
        'name' => 'Loan System',
        'namespace' => 'battambang/loan',
        'author' => 'loan',
        'url' => URL::to('loan'),
        'menu'=>array(
            'client','disburse','disburse_client','repayment','write_off',
            'category','product','center','staff','fund','holiday','exchange','fee','penalty','penalty_closing',
            'rpt_schedule','rpt_disburse_client','rpt_loan_out','rpt_loan_repay','rpt_loan_finish','rpt_collection_sheet','rpt_loan_history',
            'rpt_write_off_in','rpt_write_off_end','rpt_breakdown_currency','rpt_breakdown_purpose','rpt_nbc_7','rpt_nbc_11',
            'backup','restore'
        )
    ),
);
