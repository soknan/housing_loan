<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/12/14
 * Time: 2:38 PM
 */

namespace Battambang\Loan;


use Battambang\Cpanel\BaseController;
use Battambang\Cpanel\Company;
use Battambang\Cpanel\Facades\GetLists;
use Battambang\Cpanel\Facades\UserSession;
use Battambang\Cpanel\Libraries\Report;
use Battambang\Loan\Facades\LookupValueList;
use DB;
use Input;
use Battambang\Loan\Libraries\LoanPerformance;

class RptNBC7Controller extends BaseController
{
    public function index()
    {
        //$data['reportHistory'] = $this->_reportHistory();
        return $this->renderLayout(
            \View::make('battambang/loan::rpt_nbc_7.index')
        );
    }

    public function report()
    {
        $data = array();

        $com = Company::all()->first();
        $data['company_name'] = $com->en_name;

        $data['product_status_list'] = DB::select("SELECT * FROM ln_product_status where id !=5");

        $data['as_date'] = \Carbon::createFromFormat('d-m-Y', Input::get('as_date'))->toDateString();

        $data['cp_office'] = \Input::get('cp_office_id');
        $data['ln_staff'] = \Input::get('ln_staff_id');
        $data['cp_currency'] = \Input::get('cp_currency_id');
        $data['ln_fund'] = \Input::get('ln_fund_id');
        $data['ln_product'] = \Input::get('ln_product_id');
        $data['repay_frequency'] = \Input::get('ln_lv_repay_frequency');
        $data['classify'] = \Input::get('classify');
        $data['location_cat'] = Input::get('location_cat');
        $data['cp_location'] = \Input::get('cp_location_id');
        $data['exchange_rate_id'] = \Input::get('exchange_rate');

        /*if(strlen($data['cp_location'])!=8 and $data['cp_location']!='all'){
            return \Redirect::back()->withInput()->with('error','Please choose Village on Location !');
        }*/
        $ex = Exchange::where('id', '=', $data['exchange_rate_id'])->first();
        $data['exchange_rate'] = '1.00 $ = ' . $ex->khr_usd . ' ៛ , 1.00 B = ' . $ex->khr_thb . '៛';

        $condition = ' 1=1 ';
        $date= " AND p.activated_at <= STR_TO_DATE('" . $data['as_date'] . " 00:00:00" . "','%Y-%m-%d %H:%i:%s') ";
        //$condition.=" AND repayment_type != 'closing' or current_product_status!=5 ";

        if ($data['cp_office'] != 'all') {
            $condition .= " AND ln_client.cp_office_id  IN('" . implode("','", $data['cp_office']) . "')";
            $tmp_office = '';
            foreach ($data['cp_office'] as $office) {
                $tmp_office .= $office . ' ' . GetLists::getBranchOfficeBy($office) . ', ';
            }

            $data['cp_office'] = $tmp_office;
        }
        if ($data['ln_staff'] != 'all') {
            $condition .= " AND  ln_disburse.ln_staff_id = '" . $data['ln_staff'] . "' ";
            $staff = Staff::where('id', '=', $data['ln_staff'])->first();
            $data['ln_staff'] = $staff->id . ' ' . $staff->kh_last_name . ' ' . $staff->kh_first_name;
        }
        if ($data['cp_currency'] != 'all') {
            $condition .= " AND ln_disburse.cp_currency_id = '" . $data['cp_currency'] . " '";
            $data['cp_currency'] = Currency::where('id', '=', $data['cp_currency'])->first()->code;
        }
        if ($data['ln_fund'] != 'all') {
            $condition .= " AND ln_disburse.ln_fund_id = '" . $data['ln_fund'] . "'";
            $data['ln_fund'] = Fund::where('id', '=', $data['ln_fund'])->first()->name;
        }
        if ($data['ln_product'] != 'all') {
            $condition .= " AND ln_disburse.ln_product_id = '" . $data['ln_product'] . "'";
            $data['ln_product'] = Product::where('id', '=', $data['ln_product'])->first()->name;
        }
        if ($data['repay_frequency'] != 'all') {
            $condition .= " AND  ln_lv_repay_frequency = '" . $data['repay_frequency'] . "'";
            $data['repay_frequency'] = LookupValue::where('id', '=', $data['repay_frequency'])->first()->name;
        }
        if ($data['location_cat'] != 0) {
            $subLocation = substr($data['cp_location'], 0, ($data['location_cat'] * 2));
            $condition .= " AND cp_location_id like '" . $subLocation . "%'";
            $data['cp_location'] = array_get(\LookupValueList::getLocation($data['location_cat'], array($subLocation)), $subLocation);
        }else{
            $data['cp_location'] = 'All';
        }

        $sql = DB::select("
        SELECT *,
        ln_disburse_client.id as ln_disburse_client_id,
concat(`ln_client`.`kh_last_name`,' ',`ln_client`.`kh_first_name`) AS `client_name`,
account_type.`code` as account_type
FROM
ln_disburse_client
INNER JOIN ln_disburse ON ln_disburse_client.ln_disburse_id = ln_disburse.id
INNER JOIN ln_client ON ln_client.id = ln_disburse_client.ln_client_id
INNER JOIN ln_lookup_value account_type on account_type.id = ln_disburse.ln_lv_account_type
INNER JOIN ln_product ON ln_product.id = ln_disburse.ln_product_id
INNER JOIN ln_center ON ln_center.id = ln_disburse.ln_center_id
where $condition
and ln_disburse_client.id
not in(SELECT p.ln_disburse_client_id FROM ln_perform p WHERE p.repayment_type='closing' or p.current_product_status=5 $date)
        ");


        if (count($sql) <= 0) {
            return \Redirect::back()->withInput(Input::except('cp_office_id'))->with('error', 'No Data Found !.');
        }
        $perform = array();
        foreach ($sql as $row) {
            $loanPerform = new LoanPerformance();
            $perform[] = $loanPerform->get($row->ln_disburse_client_id, $data['as_date']);
        }
        $arr = array();
        $con_pur = array();
        foreach ($perform as $row) {
            if (!isset($tmp[$row->_current_product_status])) {
                $tmp[$row->_current_product_status] = array();
                $con_bal[$row->_current_product_status] = array();
                $con_int[$row->_current_product_status] = array();
                $con_acc[$row->_current_product_status] = array();

                $con_bal[$row->_current_product_status] = new \stdClass();
                $con_bal[$row->_current_product_status]->total = 0;
                $con_int[$row->_current_product_status] = new \stdClass();
                $con_int[$row->_current_product_status]->total = 0;
                $con_acc[$row->_current_product_status] = new \stdClass();
                $con_acc[$row->_current_product_status]->total = 0;
            }

            $tmp[$row->_current_product_status] = $row;
            $con_bal[$row->_current_product_status]->total += \Currency::toUSD($row->_disburse->cp_currency_id, $row->_balance_principal, $data['exchange_rate_id']);
            $con_int[$row->_current_product_status]->total += \Currency::toUSD($row->_disburse->cp_currency_id, $row->_balance_interest, $data['exchange_rate_id']);
            $con_acc[$row->_current_product_status]->total += $row->_disburse->num_account;
        }

        $data['con_bal'] = $con_bal;
        $data['con_int'] = $con_int;
        $data['con_acc'] = $con_acc;
        $data['result'] = $tmp;

        if (count($data['result']) <= 0) {
            return \Redirect::back()->withInput(Input::except('cp_office_id'))->with('error', 'No Data Found !.');
        }

        //var_dump($data['result']);
        //exit;

        \Report::setReportName('LOAN CLASSIFICATION, PROVISIONING AND DELINQUENCY RATIO')
            ->setDateFrom($data['as_date']);
        return \Report::make('rpt_nbc_7/source', $data, 'loan_classification');
    }

    /*private function _reportHistory()
    {
        $dir = public_path('reports/loan');
        //$files1 = scandir($dir);
        $files2 = scandir($dir, 1);
        $st = '<ul>';
        //$i=0;

        for ($i = 0; $i < count($files2) - 2; $i++) {
            if ($i >= 5) return $st .= '</ul>';
            $st .= '<li><a href="' . \URL::to('reports/loan' . $files2[$i]) . '">' . $files2[$i] . '</a></lil>';

        }
        return $st .= '</ul>';
    }*/
} 