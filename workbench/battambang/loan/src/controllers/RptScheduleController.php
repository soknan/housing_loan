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
use Battambang\Cpanel\Office;
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
//            \Report::setReportName('Schedule')->setDateFrom($data['view_at']);;
//            return \Report::make('rpt_schedule/source',$data,'repayment_schedules');
        //}

        $rptName='Repayment Schedule.xlsx';
        $objReader = new \PHPExcel_Reader_Excel2007();
        $objPHPExcel=$objReader->load(storage_path('packages/loan/'.$rptName));
        $objWorkSheet=$objPHPExcel->getActiveSheet();

        $companyName=Company::first()->kh_name;
        $office=Office::find(\UserSession::read()->sub_branch);

        // Header
        $objWorkSheet->getCell('A1')->setValue($companyName);
        $objWorkSheet->getCell('A2')->setValue('ការិយាល័យ៖ '.$office->kh_name);
        $objWorkSheet->getCell('A3')->setValue('អាសយដ្ឋាន៖ '.$office->kh_address.', ទូរស័ព្ទ៖ '.$office->telephone);

        // Page filter
        $objWorkSheet->getCell('A5')->setValue('លេខកូដ៖ '.$data['dis']->ln_disburse_client_id.' ('.$data['dis']->account_type_code.')');
        $objWorkSheet->getCell('A6')->setValue('ឈ្មោះ៖ '.$data['dis']->ln_client_kh_name);

        $gender=($data['dis']->gender_code=='M'?'ប្រុស':'ស្រី');
        $objWorkSheet->getCell('A7')->setValue('ភេទ៖ '.$gender);

        $frequency=($data['dis']->repayment_frequency_type_name=='Weekly'?'សប្តាហ៍':'ខែ');
        $objWorkSheet->getCell('A8')->setValue('ប្រភេទការសង៖ '.$frequency);

        $objWorkSheet->getCell('A9')->setValue('រយៈពេលខ្ចី៖ '.$data['dis']->num_installment.' '. $frequency);
        $objWorkSheet->getCell('A10')->setValue('អាសយដ្ឋាន៖ '.$data['dis']->address);

        $objWorkSheet->getCell('D5')->setValue('រំលស់ការ៖ '.$data['dis']->installment_frequency.' '.$frequency.'ម្តង');
        $objWorkSheet->getCell('D6')->setValue('រំលស់ដើម៖ '.$data['dis']->installment_principal_frequency.' វគ្គម្តង');
        $objWorkSheet->getCell('D7')->setValue('រំលស់ដើម៖ '.$data['dis']->installment_principal_percentage.' %');
        $objWorkSheet->getCell('D8')->setValue('អត្រាការប្រាក់៖ '.$data['dis']->interest_rate.' %');
        $objWorkSheet->getCell('D9')->setValue('ចំនួនលើកនៃការខ្ចី៖ '.$data['dis']->cycle);

        $objWorkSheet->getCell('F5')->setValue('កាលបរិច្ឆេទខ្ចី៖ '.date('d-m-Y',strtotime($data['dis']->ln_disburse_date)));
        $objWorkSheet->getCell('F6')->setValue('លេខប័ណ្ណបើកប្រាក់៖ '.substr($data['dis']->voucher_id,-6));
        if($data['dis']->cp_currency_code=='KHR'){
            $currency='រៀល';
        }elseif($data['dis']->cp_currency_code=='USD'){
            $currency='ដុល្លារ';
        }else{// THB
            $currency='បាត';
        }
        $objWorkSheet->getCell('F7')->setValue('ចំនួនទឹកប្រាក់៖ '.number_format($data['dis']->amount,2,'.',',').' '.$currency);
        $objWorkSheet->getCell('F8')->setValue('សោហ៊ុយសេវា៖ ');
        $objWorkSheet->getCell('F9')->setValue('មន្រ្តីឥណទាន៖ '.$data['dis']->ln_staff_id.' | '.$data['dis']->ln_staff_kh_name);

        // Content
        $count=count($data['result']);
        $objWorkSheet->insertNewRowBefore(14, $count);
        $objWorkSheet->removeRow(13, 2);
        foreach($data['result'] as $key=>$value){
            $rowNum=13+$key;
            $dueDate=\LookupValueList::getKhmerDay($value->due_date).' '.$value->due_date;
            $objWorkSheet->getCell('A'.$rowNum)->setValue($key);
            $objWorkSheet->getCell('B'.$rowNum)->setValue($dueDate);
            $objWorkSheet->getCell('C'.$rowNum)->setValue($value->num_day);
            $objWorkSheet->getCell('D'.$rowNum)->setValue($value->principal);
            $objWorkSheet->getCell('E'.$rowNum)->setValue($value->interest);
            $objWorkSheet->getCell('F'.$rowNum)->setValue('=D'.$rowNum.'+E'.$rowNum);
            $objWorkSheet->getCell('G'.$rowNum)->setValue($value->balance);
        }

        // Add client name and disburse date to sign
        $objWorkSheet->getCell('F'.(21-2+$count))->setValue($data['dis']->ln_client_kh_name);
        $objWorkSheet->getCell('B'.(23-2+$count))->setValue('ថ្ងៃទី '.date('d-m-Y',strtotime($data['dis']->ln_disburse_date)));
        $objWorkSheet->getCell('F'.(23-2+$count))->setValue('ថ្ងៃទី '.date('d-m-Y',strtotime($data['dis']->ln_disburse_date)));

        // redirect output to client browser
        header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$rptName.'"');
        header('Cache-Control: max-age=0');
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('php://output');

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