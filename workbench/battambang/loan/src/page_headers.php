<?php
use Battambang\Cpanel\Libraries\PageHeader\PageHeaderItem as PageHeardItem;

/*
|--------------------------------------------------------------------------
| Setting
|--------------------------------------------------------------------------
*/
PageHeader::make(
    'loan.staff.index',
    function (PageHeardItem $header) {
        $header->iconList();
        $header->add('Staff');
    }
);
PageHeader::make(
    'loan.staff.create',
    function (PageHeardItem $header) {
        $header->iconPlus();
        $header->add('Staff');
    }
);
PageHeader::make(
    'loan.staff.edit',
    function (PageHeardItem $header) {
        $header->iconEdit();
        $header->add('Staff');
    }
);
PageHeader::make(
    'loan.center.index',
    function (PageHeardItem $header) {
        $header->iconList();
        $header->add('Center');
    }
);
PageHeader::make(
    'loan.center.create',
    function (PageHeardItem $header) {
        $header->iconPlus();
        $header->add('Center');
    }
);
PageHeader::make(
    'loan.center.edit',
    function (PageHeardItem $header) {
        $header->iconEdit();
        $header->add('Center');
    }
);
PageHeader::make(
    'loan.fund.index',
    function (PageHeardItem $header) {
        $header->iconList();
        $header->add('Fund');
    }
);
PageHeader::make(
    'loan.fund.create',
    function (PageHeardItem $header) {
        $header->iconPlus();
        $header->add('Fund');
    }
);
PageHeader::make(
    'loan.fund.edit',
    function (PageHeardItem $header) {
        $header->iconEdit();
        $header->add('Fund');
    }
);
PageHeader::make(
    'loan.fee.index',
    function (PageHeardItem $header) {
        $header->iconList();
        $header->add('Fee');
    }
);
PageHeader::make(
    'loan.fee.create',
    function (PageHeardItem $header) {
        $header->iconPlus();
        $header->add('Free');
    }
);
PageHeader::make(
    'loan.fee.edit',
    function (PageHeardItem $header) {
        $header->iconEdit();
        $header->add('Free');
    }
);
PageHeader::make(
    'loan.penalty.index',
    function (PageHeardItem $header) {
        $header->iconList();
        $header->add('Penalty');
    }
);
PageHeader::make(
    'loan.penalty.create',
    function (PageHeardItem $header) {
        $header->iconPlus();
        $header->add('Penalty');
    }
);
PageHeader::make(
    'loan.penalty.edit',
    function (PageHeardItem $header) {
        $header->iconEdit();
        $header->add('Penalty');
    }
);
PageHeader::make(
    'loan.penalty_closing.index',
    function (PageHeardItem $header) {
        $header->iconList();
        $header->add('Penalty Closing');
    }
);
PageHeader::make(
    'loan.penalty_closing.create',
    function (PageHeardItem $header) {
        $header->iconPlus();
        $header->add('Penalty Closing');
    }
);
PageHeader::make(
    'loan.penalty_closing.edit',
    function (PageHeardItem $header) {
        $header->iconEdit();
        $header->add('Penalty Closin');
    }
);
PageHeader::make(
    'loan.holiday.index',
    function (PageHeardItem $header) {
        $header->iconList();
        $header->add('Holiday');
    }
);
PageHeader::make(
    'loan.holiday.create',
    function (PageHeardItem $header) {
        $header->iconPlus();
        $header->add('Holiday');
    }
);
PageHeader::make(
    'loan.holiday.edit',
    function (PageHeardItem $header) {
        $header->iconEdit();
        $header->add('Holiday');
    }
);
PageHeader::make(
    'loan.category.index',
    function (PageHeardItem $header) {
        $header->iconList();
        $header->add('Product Category');
    }
);
PageHeader::make(
    'loan.category.create',
    function (PageHeardItem $header) {
        $header->iconPlus();
        $header->add('Product Category');
    }
);
PageHeader::make(
    'loan.category.edit',
    function (PageHeardItem $header) {
        $header->iconEdit();
        $header->add('Product Category');
    }
);
PageHeader::make(
    'loan.product.index',
    function (PageHeardItem $header) {
        $header->iconList();
        $header->add('Product Type');
    }
);
PageHeader::make(
    'loan.product.create',
    function (PageHeardItem $header) {
        $header->iconPlus();
        $header->add('Product Type');
    }
);
PageHeader::make(
    'loan.product.edit',
    function (PageHeardItem $header) {
        $header->iconEdit();
        $header->add('Product Type');
    }
);

/*
|--------------------------------------------------------------------------
| Manage Data
|--------------------------------------------------------------------------
*/
PageHeader::make(
    'loan.client.index',
    function (PageHeardItem $header) {
        $header->iconList();
        $header->add('Client');
    }
);
PageHeader::make(
    'loan.client.create',
    function (PageHeardItem $header) {
        $header->iconPlus();
        $header->add('Client');
    }
);
PageHeader::make(
    'loan.client.edit',
    function (PageHeardItem $header) {
        $header->iconEdit();
        $header->add('Client');
    }
);
PageHeader::make(
    'loan.disburse.index',
    function (PageHeardItem $header) {
        $header->iconList();
        $header->add('Disbursement');
    }
);
PageHeader::make(
    'loan.disburse.create',
    function (PageHeardItem $header) {
        $header->iconPlus();
        $header->add('Disbursement');
    }
);
PageHeader::make(
    'loan.disburse.edit',
    function (PageHeardItem $header) {
        $header->iconEdit();
        $header->add('Disbursement');
    }
);
PageHeader::make(
    'loan.disburse.add',
    function (PageHeardItem $header) {
        $header->iconChevronRight();
        $header->add('Center, Product');
    }
);
PageHeader::make(
    'loan.disburse.attach_file',
    function (PageHeardItem $header) {
        $header->iconPlus();
        $header->add('Attachment File');
    }
);
PageHeader::make(
    'loan.disburse_client.index',
    function (PageHeardItem $header) {
        $header->iconList();
        $header->add('Disbursement Client');
    }
);
PageHeader::make(
    'loan.disburse_client.create',
    function (PageHeardItem $header) {
        $header->iconPlus();
        $header->add('Disbursement Client');
    }
);
PageHeader::make(
    'loan.disburse_client.edit',
    function (PageHeardItem $header) {
        $header->iconEdit();
        $header->add('Disbursement Client');
    }
);
PageHeader::make(
    'loan.disburse_client.add',
    function (PageHeardItem $header) {
        $header->iconChevronRight();
        $header->add('Client');
    }
);
PageHeader::make(
    'loan.repayment.index',
    function (PageHeardItem $header) {
        $header->iconList();
        $header->add('Repayment');
    }
);
PageHeader::make(
    'loan.repayment.create',
    function (PageHeardItem $header) {
        $header->iconPlus();
        $header->add('Repayment');
    }
);
PageHeader::make(
    'loan.repayment.edit',
    function (PageHeardItem $header) {
        $header->iconEdit();
        $header->add('Repayment');
    }
);
PageHeader::make(
    'loan.write_off.index',
    function (PageHeardItem $header) {
        $header->iconList();
        $header->add('Write-Off');
    }
);
PageHeader::make(
    'loan.write_off.create',
    function (PageHeardItem $header) {
        $header->iconPlus();
        $header->add('Write-Off');
    }
);
PageHeader::make(
    'loan.write_off.edit',
    function (PageHeardItem $header) {
        $header->iconEdit();
        $header->add('Write-Off');
    }
);
PageHeader::make(
    'loan.exchange.index',
    function (PageHeardItem $header) {
        $header->iconList();
        $header->add('Exchange');
    }
);
PageHeader::make(
    'loan.exchange.create',
    function (PageHeardItem $header) {
        $header->iconPlus();
        $header->add('Exchange');
    }
);
PageHeader::make(
    'loan.exchange.edit',
    function (PageHeardItem $header) {
        $header->iconEdit();
        $header->add('Exchange');
    }
);
/*
|--------------------------------------------------------------------------
| Reports
|--------------------------------------------------------------------------
*/
PageHeader::make(
    'loan.rpt_loan_late.index',
    function (PageHeardItem $header) {
        $header->iconFloppyDisk();
        $header->add('Loan Late Report');
    }
);
PageHeader::make(
    'loan.rpt_loan_fee.index',
    function (PageHeardItem $header) {
        $header->iconFloppyDisk();
        $header->add('Repay Fee Report');
    }
);
PageHeader::make(
    'loan.rpt_schedule.index',
    function (PageHeardItem $header) {
        $header->iconFloppyDisk();
        $header->add('Repayment Schedule Report');
    }
);
PageHeader::make(
    'loan.rpt_disburse_client.index',
    function (PageHeardItem $header) {
        $header->iconFloppyDisk();
        $header->add('Loan disbursement Report');
    }
);
PageHeader::make(
    'loan.rpt_loan_out.index',
    function (PageHeardItem $header) {
        $header->iconFloppyDisk();
        $header->add('Loan Outstanding Report');
    }
);
PageHeader::make(
    'loan.rpt_loan_repay.index',
    function (PageHeardItem $header) {
        $header->iconFloppyDisk();
        $header->add('Loan Repayment Report');
    }
);
PageHeader::make(
    'loan.rpt_loan_finish.index',
    function (PageHeardItem $header) {
        $header->iconFloppyDisk();
        $header->add('Loan Closing Report');
    }
);
PageHeader::make(
    'loan.rpt_collection_sheet.index',
    function (PageHeardItem $header) {
        $header->iconFloppyDisk();
        $header->add('Collection Sheet Report');
    }
);
PageHeader::make(
    'loan.rpt_loan_history.index',
    function (PageHeardItem $header) {
        $header->iconFloppyDisk();
        $header->add('Loan History Report');
    }
);
PageHeader::make(
    'loan.rpt_write_off_in.index',
    function (PageHeardItem $header) {
        $header->iconFloppyDisk();
        $header->add('Write-Off (In Period) Report');
    }
);
PageHeader::make(
    'loan.rpt_write_off_end.index',
    function (PageHeardItem $header) {
        $header->iconFloppyDisk();
        $header->add('Write-Off (End Period) Report');
    }
);
PageHeader::make(
    'loan.rpt_breakdown_purpose.index',
    function (PageHeardItem $header) {
        $header->iconFloppyDisk();
        $header->add('Loan BreakDown By Purpose');
    }
);
PageHeader::make(
    'loan.rpt_breakdown_currency.index',
    function (PageHeardItem $header) {
        $header->iconFloppyDisk();
        $header->add('Loan BreakDown By Currency');
    }
);
PageHeader::make(
    'loan.rpt_nbc_7.index',
    function (PageHeardItem $header) {
        $header->iconFloppyDisk();
        $header->add('Loan Classification, Provisioning and Delinquency Ratio');
    }
);
PageHeader::make(
    'loan.rpt_nbc_11.index',
    function (PageHeardItem $header) {
        $header->iconFloppyDisk();
        $header->add('Loan Network Information');
    }
);

/*
|--------------------------------------------------------------------------
| Tool
|--------------------------------------------------------------------------
*/
PageHeader::make(
    'loan.backup.index',
    function (PageHeardItem $header) {
        $header->icon('cloud-download');
        $header->add('Backup');
    }
);
PageHeader::make(
    'loan.restore.index',
    function (PageHeardItem $header) {
        $header->icon('cloud-upload');
        $header->add('Restore');
    }
);
