<?php
return array(
    //menu 2 type are available single or dropdown and it must be a url
    'Manage Data' =>array(
        'type' => 'dropdown',
        'links' => array(
           /* 'Dashboard' => array(
                'type' => 'single',
                'url' => route('loan.dashboard.index')
            ),*/
            'Clients' => array(
                'type' => 'single',
                'url' => route('loan.client.index')
            ),
            'Disbursement' => array(
                'type' => 'single',
                'url' => route('loan.disburse.index')
            ),
            'Repayment' => array(
                'type' => 'single',
                'url' => route('loan.repayment.index')
            ),
            'Loan Write-Off' => array(
                'type' => 'single',
                'url' => route('loan.write_off.index')
            ),
        )
    ),

    'Setting' => array(
        'type' => 'dropdown', 
        'links' => array(
            'Category' => array(
                'type' => 'single',
                'url' => route('loan.category.index')
            ),
            'Product' => array(
                'type' => 'single',
                'url' => route('loan.product.index')
            ),
            'Centers' => array(
                'type' => 'single',
                'url' => route('loan.center.index')
            ),
            'Staff' => array(
                'type' => 'single',
                'url' => route('loan.staff.index')
            ),
            'Fund' => array(
                'type' => 'single',
                'url' => route('loan.fund.index')
            ),
            'Holiday' => array(
                'type' => 'single',
                'url' => route('loan.holiday.index')
            ),
            'Exchange' => array(
                'type' => 'single',
                'url' => route('loan.exchange.index')
            ),
            'Fee' => array(
                'type' => 'single',
                'url' => route('loan.fee.index')
            ),
            'Penalty' => array(
                'type' => 'single',
                'url' => route('loan.penalty.index')
            ),
            'Penalty Closing' => array(
                'type' => 'single',
                'url' => route('loan.penalty_closing.index')
            ),

            /*'Lookup' => array(
                'type' => 'single',
                'url' => route('loan.lookup.index')
            ),
            'Lookup Value' => array(
                'type' => 'single',
                'url' => route('loan.lookup_value.index')
            ),*/
        ),

    ),

    'Reports' =>array(
        'type' => 'dropdown',
        'links' => array(
            'Repayment Schedules' => array(
                'type' => 'single',
                'url' => route('loan.rpt_schedule.index')
            ),
            'Loan Disbursement' => array(
                'type' => 'single',
                'url' => route('loan.rpt_disburse_client.index')
            ),
            'Loan Outstanding' => array(
                'type' => 'single',
                'url' => route('loan.rpt_loan_out.index')
            ),
            'Loan Repay' => array(
                'type' => 'single',
                'url' => route('loan.rpt_loan_repay.index')
            ),
            'Loan Closing' => array(
                'type' => 'single',
                'url' => route('loan.rpt_loan_finish.index')
            ),
            'Collection Sheet' => array(
                'type' => 'single',
                'url' => route('loan.rpt_collection_sheet.index')
            ),
            'Loan History' => array(
                'type' => 'single',
                'url' => route('loan.rpt_loan_history.index')
            ),
            'Write-Off (In Period)' => array(
                'type' => 'single',
                'url' => route('loan.rpt_write_off_in.index')
            ),
            'Write-Off (End Period)' => array(
                'type' => 'single',
                'url' => route('loan.rpt_write_off_end.index')
            ),
            'Summary Report' => array(
                'type' => 'dropdown',
                'links' => array(
                    'Loan BreakDown By Purpose' => array(
                        'type' => 'single',
                        'url' => route('loan.rpt_breakdown_purpose.index')
                    ),
                    'Loan BreakDown By Currency' => array(
                        'type' => 'single',
                        'url' => route('loan.rpt_breakdown_currency.index')
                    ),
                    'Loan Classification, Provisioning and Delinquency Ratio' => array(
                        'type' => 'single',
                        'url' =>route('loan.rpt_nbc_7.index')
                    ),
                    'Network Information' => array(
                        'type' => 'single',
                        'url' => route('loan.rpt_nbc_11.index')
                    ),
                ),
            ),
        )
    ),
    'Tools' =>array(
        'type' => 'dropdown',
        'links' => array(
            'Backup' => array(
                'type' => 'single',
                'url' => route('loan.backup.index')
            ),
            'Restore' => array(
                'type' => 'single',
                'url' => route('loan.restore.index')
            ),
        )
    ),

);
