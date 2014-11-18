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
use DB;
use Input;
use Battambang\Loan\Libraries\LoanPerformance;
use Battambang\Loan\Schedule;

class RptLoanHistoryController extends BaseController
{
    public function index()
    {
        //$data['reportHistory'] = $this->_reportHistory();
        return $this->renderLayout(
            \View::make('battambang/loan::rpt_loan_history.index')
        );
    }

    public function report()
    {
        $data = array();
        $com = Company::all()->first();
        $data['company_name'] = $com->en_name;
        $data['ln_client_id'] = Input::get('ln_client_id');
        $data['view_at'] = \Input::get('view_at');
        $data['branch'] = \UserSession::read()->sub_branch.' '.\GetLists::getBranchOfficeBy(\UserSession::read()->sub_branch);

        $data['client'] = ClientLoan::where('id','=',$data['ln_client_id'])->first();
        $data['disburse'] = DB::select('
select *,ln_disburse_client.id as id FROM ln_disburse_client INNER JOIN ln_disburse
on ln_disburse_client.ln_disburse_id = ln_disburse.id
INNER JOIN ln_client
on ln_disburse_client.ln_client_id = ln_client.id where ln_client.id = "'.$data['ln_client_id'].'" ');
       /* foreach($data['disburse'] as $row){
            $data['schedule'] = Schedule::where('ln_disburse_client_id','=',$row->id)
                ->join('ln_schedule_dt', 'ln_schedule.id', '=', 'ln_schedule_dt.ln_schedule_id')->get();
            $data['perform'][] = Perform::where('ln_disburse_client_id','=',$row->id)->get();
            //$data['result'] = $row;
        }*/
        //echo $data['result'][0]->kh_first_name;
        //var_dump($data['schedule']);
        //var_dump($data['result'][3]->_arrears);
        //exit;
        // User action
        \Event::fire('user_action.report', array('rpt_loan_history'));
        if (count($data) <= 0) {
            return \Redirect::back()->withInput()->with('error', 'No Data Found !.');
        }
        \Report::setReportName('Loan History')
            ->setDateFrom($data['view_at']);

        return \Report::make('rpt_loan_history/source', $data,'loan_history');

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