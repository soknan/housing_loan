@extends(Config::get('battambang/cpanel::views.layout'))

@section('content')

{{ Former::open() }}

<?php
echo FormPanel2::make(
    'General',
    Former::text('disburse_date', 'Disburse Date', date('d-m-Y',strtotime($row->disburse_date)))
        ->disabled()
        ->append('mm/dd/yyyy')->required() . ''
    . Former::select('ln_lv_account_type', 'Account')
        ->options($account_type_arr, $row->ln_lv_account_type)
        ->required()
        ->placeholder('- Select One -')
        ->disabled()
    ,
    Former::select('cp_currency_id', 'Currency')
        ->options($currency_arr, $row->cp_currency_id)
        ->required()
        ->disabled()
        ->placeholder('- Select One -') . ''
);

echo FormPanel2::make(
    'Center',
    Former::select('ln_center_id', 'Center', LookupValueList::getCenter($ln_center_id))
        ->required()
        ->disabled(). ''
    . Former::select('ln_lv_meeting_schedule', 'Meeting', LookupValueList::jsonData($ln_lv_meeting))
        ->disabled()->required()
    ,
    Former::select('ln_staff_id', 'Staff', LookupValueList::getStaff($ln_staff_id))
        ->required()
        ->disabled(). ''
);

echo FormPanel2::make(
    'Product',
    Former::select('ln_product_id', 'Product', LookupValueList::getProduct($ln_product_id))
        ->required()
        ->disabled(). ''
    . Former::select('num_installment', 'Num Installment')
        ->options($installment, $row->num_installment)
        ->required()
        ->disabled()
        ->placeholder('- Select One -')
    . Former::select('installment_frequency', 'Interest Frequency')
        ->options($int_fre, $row->installment_frequency)
        ->placeholder('- Select One -')
        ->required()
        ->disabled()
    . Former::text('num_payment', 'Number Payment', $row->num_payment)
        ->readonly('readonly')
        ->required()
    . Former::select('installment_principal_frequency', 'Principal Frequency')
        ->options($ins_pri_fre, $row->installment_principal_frequency)
        ->required()
        ->disabled()
        ->placeholder('- Select One -')
    ,
    Former::select('installment_principal_percentage', 'Principal %')
        ->options($insPriPercentage, $row->installment_principal_percentage)
        ->required()
        ->disabled()
        ->placeholder('- Select One -')
        ->append('%') . ''
    . Former::number('interest_rate', 'Interest', $row->interest_rate)
        ->step('0.01')
        ->min($min_interest)
        ->max($max_interest)
        ->required()
        ->disabled()
        ->append($min_interest . '% - ' . $max_interest . '%')
    . Former::select('ln_fund_id', 'Fund')
        ->options($fund_arr, $row->ln_fund_id)
        ->required()
        ->disabled()
        ->placeholder('- Select One -')
    . Former::file('attach_file', 'Attach Files')
);

?>



{{Former::close()}}

@stop
@section('js')
<?php echo DatePicker::make('disburse_date'); ?>
<script>
    $(document).ready(function () {
        //$('[name="num_installment"]').ready(changeNumInstall);
        $('[name="num_installment"]').change(changeNumInstall).change(changeIntFre).change(changeNumPay);

        //$('[name="installment_frequency"]').ready(changeIntFre);
        $('[name="installment_frequency"]').change(changeIntFre).change(changeNumPay);
        $('[name="num_payment"]').ready(changeNumPay);

        /*$('[name = "num_installment"]').change(function () {
            changeNumInstall();
        });

        $('[name = "installment_frequency"]').change(function () {
            changeIntFre();
        });
        $('[name = "installment_frequency"]').focus(function () {
            changeIntFre();
        });

        $('[name = "num_payment"]').focus(function () {
            changeNumPay();
        });*/

        function changeNumInstall() {
            var num_installment = $('[name = "num_installment"]');
            var int_fre = $('[name = "installment_frequency"]');
            var num_payment = $('[name = "num_payment"]');
            var num_installment_fre = $('[name = "installment_principal_frequency"]');
            int_fre.html('');
            num_payment.val('');
            num_installment_fre.html('');
            for (var i = 1; i <= num_installment.val(); i++) {
                int_fre.append(' <option value = "' + i + '" > ' + i + '</option>');
            }
            //int_fre.focus();
        }

        function changeIntFre() {
            var int_fre = $('[name = "installment_frequency"]');
            var num_installment = $('[name = "num_installment"]');
            var num_payment = $('[name = "num_payment"]');
            var tmp = (num_installment.val() / int_fre.val())
            //alert(tmp);
            num_payment.val(Math.ceil(tmp));
            //num_payment.focus();
        }

        function changeNumPay() {
            var num_payment = $('[name = "num_payment"]');
            var num_installment_fre = $('[name = "installment_principal_frequency"]');
            num_installment_fre.html('');
            for (var i = 1; i <= num_payment.val(); i++) {
                num_installment_fre.append(' <option value = "' + i + '" > ' + i + '</option> ');
            }
        }

    });
</script>
@stop
