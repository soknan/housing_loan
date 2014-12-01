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
            'province' => array(
                'cpanel.province.index' => 'list',
                'cpanel.province.create' => 'create',
                'cpanel.province.edit' => 'edit',
                'cpanel.province.destroy' => 'delete',
            ),
            'district' => array(
                'cpanel.district.index' => 'list',
                'cpanel.district.create' => 'create',
                'cpanel.district.edit' => 'edit',
                'cpanel.district.destroy' => 'delete',
            ),
            'commune' => array(
                'cpanel.commune.index' => 'list',
                'cpanel.commune.create' => 'create',
                'cpanel.commune.edit' => 'edit',
                'cpanel.commune.destroy' => 'delete',
            ),
            'village' => array(
                'cpanel.village.index' => 'list',
                'cpanel.village.create' => 'create',
                'cpanel.village.edit' => 'edit',
                'cpanel.village.destroy' => 'delete',
            ),
            'Tool' => array(
                'loan.backup.index' => 'backup',
                'loan.restore.index' => 'restore',
            ),
        )
    ),
    'loan' => array(
        'name' => 'Loan System',
        'namespace' => 'battambang/loan',
        'author' => 'loan',
        'url' => URL::to('loan'),
        'menu' => array(
            'fund' => array(
                'loan.fund.index' => 'list',
                'loan.fund.create' => 'create',
                'loan.fund.edit' => 'edit',
                'loan.fund.destroy' => 'delete',
            ),
            'fee' => array(
                'loan.fee.index' => 'list',
                'loan.fee.create' => 'create',
                'loan.fee.edit' => 'edit',
                'loan.fee.destroy' => 'delete',
            ),
            'penalty' => array(
                'loan.penalty.index' => 'list',
                'loan.penalty.create' => 'create',
                'loan.penalty.edit' => 'edit',
                'loan.penalty.destroy' => 'delete',
            ),
            'penalty closing' => array(
                'loan.penalty_closing.index' => 'list',
                'loan.penalty_closing.create' => 'create',
                'loan.penalty_closing.edit' => 'edit',
                'loan.penalty_closing.destroy' => 'delete',
            ),
            'holiday' => array(
                'loan.holiday.index' => 'list',
                'loan.holiday.create' => 'create',
                'loan.holiday.edit' => 'edit',
                'loan.holiday.destroy' => 'delete',
            ),
            'category' => array(
                'loan.category.index' => 'list',
                'loan.category.create' => 'create',
                'loan.category.edit' => 'edit',
                'loan.category.destroy' => 'delete',
            ),
            'product' => array(
                'loan.product.index' => 'list',
                'loan.product.create' => 'create',
                'loan.product.edit' => 'edit',
                'loan.product.destroy' => 'delete',
            ),
            'staff' => array(
                'loan.staff.index' => 'list',
                'loan.staff.create' => 'create',
                'loan.staff.edit' => 'edit',
                'loan.staff.destroy' => 'delete',
            ),
            'center' => array(
                'loan.center.index' => 'list',
                'loan.center.create' => 'create',
                'loan.center.edit' => 'edit',
                'loan.center.destroy' => 'delete',
            ),
            'client' => array(
                'loan.client.index' => 'list',
                'loan.client.create' => 'create',
                'loan.client.edit' => 'edit',
                'loan.client.destroy' => 'delete',
            ),
            'disbursement' => array(
                'loan.disburse.index' => 'list',
                'loan.disburse.create' => 'create',
                'loan.disburse.edit' => 'edit',
                'loan.disburse.destroy' => 'delete',
                'loan.disburse.attach_file' => 'attachment file',
            ),
            'disbursement client' => array(
                'loan.disburse_client.index' => 'list',
                'loan.disburse_client.create' => 'create',
                'loan.disburse_client.edit' => 'edit',
                'loan.disburse_client.destroy' => 'delete',
            ),
            'repayment' => array(
                'loan.repayment.index' => 'list',
                'loan.repayment.create' => 'create',
                'loan.repayment.edit' => 'edit',
                'loan.repayment.destroy' => 'delete',
            ),
            'write off' => array(
                'loan.write_off.index' => 'list',
                'loan.write_off.create' => 'create',
                'loan.write_off.edit' => 'edit',
                'loan.write_off.destroy' => 'delete',
            ),
            'exchange' => array(
                'loan.exchange.index' => 'list',
                'loan.exchange.create' => 'create',
                'loan.exchange.edit' => 'edit',
                'loan.exchange.destroy' => 'delete',
            ),
            'default report' => array(
                'loan.rpt_schedule.index' => 'loan repayment schedule',
                'loan.rpt_disburse_client.index' => 'loan disbursement',
                'loan.rpt_loan_out.index' => 'loan out standing',
                'loan.rpt_loan_late.index' => 'loan late',
                'loan.rpt_loan_fee.index' => 'Fee repayment',
                'loan.rpt_loan_repay.index' => 'loan repayment',
                'loan.rpt_loan_finish.index' => 'loan closing',
                'loan.rpt_collection_sheet.index' => 'loan collection sheet',
                'loan.rpt_loan_history.index' => 'loan history',
                'loan.rpt_write_off_in.index' => 'loan write off (in period)',
                'loan.rpt_write_off_end.index' => 'loan write off (end period)',
            ),
            'summary report' => array(
                'loan.rpt_breakdown_purpose.index' => 'loan breakdown by purpose',
                'loan.rpt_breakdown_currency.index' => 'loan breakdown by currency',
                'loan.rpt_nbc_7.index' => 'loan classification, provisioning and delinquency ratio',
                'loan.rpt_nbc_11.index' => 'loan network information',
            ),
            'tool' => array(
                'loan.backup.index' => 'backup',
                'loan.restore.index' => 'restore',
            ),
        )
    ),
);