<?php
Menu::make(
    'loan',
    function ($menu) {
        // Manage Data
        $menu->add(
            'Manage Data',
            function ($dropdown) {
                $dropdown->add('Clients', route('loan.client.index'));
                $dropdown->add('Disbursement', route('loan.disburse.index'));
                $dropdown->add('Repayment', route('loan.repayment.index'));
                $dropdown->add('Loan Write-Off', route('loan.write_off.index'));
                $dropdown->divider();
                $dropdown->add('Exchange', route('loan.exchange.index'));
                $dropdown->add('Centers', route('loan.center.index'));
            }
        );

        // Setting
        $menu->add(
            'Setting',
            function ($dropdown) {
                $dropdown->add('Fund', route('loan.fund.index'));
                $dropdown->add('Fee', route('loan.fee.index'));
                $dropdown->add('Penalty', route('loan.penalty.index'));
                $dropdown->add('Penalty Closing', route('loan.penalty_closing.index'));
                $dropdown->add('Holiday', route('loan.holiday.index'));
                $dropdown->add(
                    'Product',
                    function ($dropdown) {
                        $dropdown->add('Category', route('loan.category.index'));
                        $dropdown->add('Type', route('loan.product.index'));
                    }
                );
                $dropdown->add('Staff', route('loan.staff.index'));
            }
        );

        // Report
        $menu->add(
            'Repors',
            function ($dropdown) {
                $dropdown->add('Repayment Schedule', route('loan.rpt_schedule.index'));
                $dropdown->add('Loan Disbursement', route('loan.rpt_disburse_client.index'));
                $dropdown->add('Loan Outstanding', route('loan.rpt_loan_out.index'));
                $dropdown->add('Loan Late', route('loan.rpt_loan_late.index'));
                $dropdown->add('Loan Repayment', route('loan.rpt_loan_repay.index'));
                $dropdown->add('Loan Repay Fee', route('loan.rpt_loan_fee.index'));
                $dropdown->add('Loan Closing', route('loan.rpt_loan_finish.index'));
                $dropdown->add('Collection Sheet', route('loan.rpt_collection_sheet.index'));
                $dropdown->add('Loan History', route('loan.rpt_loan_history.index'));
                $dropdown->add('Write-Off (In Period)', route('loan.rpt_write_off_in.index'));
                $dropdown->add('Write-Off (End Period)', route('loan.rpt_write_off_end.index'));
                $dropdown->add(
                    'Summary',
                    function ($dropdown) {
                        $dropdown->add('Loan BreakDown By Purpose', route('loan.rpt_breakdown_purpose.index'));
                        $dropdown->add('Loan BreakDown By Currency', route('loan.rpt_breakdown_currency.index'));
                        $dropdown->add(
                            'Loan Classification, Provisioning and Delinquency Ratio',
                            route('loan.rpt_nbc_7.index')
                        );
                        $dropdown->add('Network Information', route('loan.rpt_nbc_11.index'));

                    }
                );
            }
        );
    }
);

Menu::make(
    'tool',
    function ($menu) {
        $menu->add(
            'Tool',
            function ($dropdown) {
                $dropdown->add('Backup', route('loan.backup.index'));
                $dropdown->add('Restore', route('loan.restore.index'));
            }
        );
    }
);
