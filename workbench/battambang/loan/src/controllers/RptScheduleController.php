<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/12/14
 * Time: 2:38 PM
 */

namespace Battambang\Loan;


use Battambang\Cpanel\BaseController;
use Battambang\Cpanel\Libraries\Report;
use DB;

class RptScheduleController extends BaseController{
    public function index(){
        $data['disburseClient'] = $this->_getLoanAccount();
        //$data['reportHistory'] = $this->_reportHistory();
        return $this->renderLayout(
            \View::make('battambang/loan::rpt_schedule.index',$data)
        );
    }

    public function report(){
        $data = array();

        /*if($id!='{id}'){
            $id = $id;
            $data['view_at'] = date('d-m-Y');
        }else{
            $id = \Input::get('ln_disburse_client_id');
            $data['view_at'] = date('d-m-Y',strtotime(\Input::get('view_at')));
        }*/
        $id = \Input::get('ln_disburse_client_id');
        $data['view_at'] = date('d-m-Y',strtotime(\Input::get('view_at')));
        //return $id;
        $data['dis'] = \DB::table('view_schedule_report')->where('ln_disburse_client_id','=',$id)->first();

        ($data['dis']->repayment_frequency_type_code == 'W')? $data['dis']->repayment_frequency_type_code = 'សប្ដាហ៍': $data['dis']->repayment_frequency_type_code ='ខែ';

        $data['result'] = Schedule::where('ln_disburse_client_id','=',$id)
            ->join('ln_schedule_dt', 'ln_schedule.id', '=', 'ln_schedule_dt.ln_schedule_id')->get();

        //$khDay[] = explode('-',date('D-d-M-Y',$data['result'][0]->due_date));

        //echo date('D-d-M-Y',strtotime($data['result'][0]->due_date));
        //exit;
        //return \Excel::loadView('battambang/loan::rpt_schedule.pdf', $data)->export('xls');

        //if(count($data)>0){
            \Report::setReportName('Schedule')->setDateFrom($data['view_at']);;
            return \Report::make('rpt_schedule/source',$data,'repayment_schedules');
        //}



    }

    private function _getLoanAccount(){
        $perform = array('');
        foreach (Perform::all() as $row) {
            $perform[] = $row->ln_disburse_client_id;
        }
        $data = DB::table('view_disburse_client')->whereIn('id',$perform)->orderBy('id', 'desc')->get();
        $arr = array();
        foreach ($data as $row) {
            $arr[$row->id] = $row->id . ' || ' . $row->client_kh_name . ' || ' . date('d-M-Y', strtotime($row->disburse_date));
        }
        return $arr;
    }

    /*private function _reportHistory(){
        $dir    = public_path('reports/loan');
        $files2 = scandir($dir, 1);
        $st='<ul>';
        for ($i=0;$i<count($files2)-2;$i++) {
            if($i >= 5) return $st.='</ul>';
             $st.='<li><a href="'.\URL::to('reports/loan'.$files2[$i]).'">'.$files2[$i].'</a></li>';

        }
         return $st.='</ul>';
    }*/
} 