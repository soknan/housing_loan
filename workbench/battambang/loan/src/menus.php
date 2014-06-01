<?php

Menu::create(
    'loan',
    function ($menu) {

        // Manage Data
        $menu->add(
            [
                'title' => 'Manage Data',
                'url' => '#',
//                'icon' => 'fa fa-user'
            ]
        )
            ->child(
                [
                    'title' => 'Clients',
                    'url' => route('loan.client.index')
                ]
            )->child(
                [
                    'title' => 'Disbursement',
                    'url' => route('loan.disburse.index')
                ]
            )->child(
                [
                    'title' => 'Repayment',
                    'url' => route('loan.repayment.index')
                ]
            )->child(
                [
                    'title' => 'Loan Write-Off',
                    'url' => route('loan.write_off.index')
                ]
            )->child(
                [
                    'title' => 'Exchange',
                    'url' => route('loan.exchange.index')
                ]
            );

        // Setting
        $menu->add(
            [
                'title' => 'Setting',
                'url' => '#',
//                'icon' => 'fa fa-user'
            ]
        )
            ->child(
                [
                    'title' => 'Staff',
                    'url' => route('loan.staff.index')
                ]
            )
            ->child(
                [
                    'title' => 'Centers',
                    'url' => route('loan.center.index')
                ]
            )->child(
                [
                    'title' => 'Fund',
                    'url' => route('loan.fund.index')
                ]
            )->child(
                [
                    'title' => 'Fee',
                    'url' => route('loan.fee.index')
                ]
            )->child(
                [
                    'title' => 'Penalty',
                    'url' => route('loan.penalty.index')
                ]
            )->child(
                [
                    'title' => 'Penalty Closing',
                    'url' => route('loan.penalty_closing.index')
                ]
            )->child(
                [
                    'title' => 'Holiday',
                    'url' => route('loan.holiday.index')
                ]
            )
            ->addDivider()
            ->child(
                [
                    'title' => 'Product Category',
                    'url' => route('loan.category.index')
                ]
            )->child(
                [
                    'title' => 'Product Type',
                    'url' => route('loan.product.index')
                ]
            );

        // Report
        $menu->add(
            [
                'title' => 'Reports',
                'url' => '#',
//                'icon' => 'fa fa-user'
            ]
        )
            ->child(
                [
                    'title' => 'Repayment Schedules',
                    'url' => route('loan.rpt_schedule.index')
                ]
            )
            ->child(
                [
                    'title' => 'Loan Disbursement',
                    'url' => route('loan.rpt_disburse_client.index')
                ]
            )->child(
                [
                    'title' => 'Loan Outstanding',
                    'url' => route('loan.rpt_loan_out.index')
                ]
            )->child(
                [
                    'title' => 'Loan Repay',
                    'url' => route('loan.rpt_loan_repay.index')
                ]
            )->child(
                [
                    'title' => 'Loan Closing',
                    'url' => route('loan.rpt_loan_finish.index')
                ]
            )->child(
                [
                    'title' => 'Collection Sheet',
                    'url' => route('loan.rpt_collection_sheet.index')
                ]
            )->child(
                [
                    'title' => 'Loan History',
                    'url' => route('loan.rpt_loan_history.index')
                ]
            )->child(
                [
                    'title' => 'Write-Off (In Period)',
                    'url' => route('loan.rpt_write_off_in.index')
                ]
            )->child(
                [
                    'title' => 'Write-Off (End Period)',
                    'url' => route('loan.rpt_write_off_end.index')
                ]
            )
            ->addDivider()
            ->child(
                [
                    'title' => 'Loan BreakDown By Purpose',
                    'url' => route('loan.rpt_breakdown_purpose.index')
                ]
            )->child(
                [
                    'title' => 'Loan BreakDown By Currency',
                    'url' => route('loan.rpt_breakdown_currency.index')
                ]
            )->child(
                [
                    'title' => 'Loan Classification, Provisioning and Delinquency Ratio',
                    'url' => route('loan.rpt_nbc_7.index')
                ]
            )->child(
                [
                    'title' => 'Network Information',
                    'url' => route('loan.rpt_nbc_11.index')
                ]
            );
    }
);