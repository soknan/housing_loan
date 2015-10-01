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
        return $this->renderLayout(
            \View::make('battambang/loan::rpt_schedule.index')
        );
    }

    public function report(){
        $data = array();

        $id = \Input::get('ln_disburse_client_id');
        $data['view_at'] = date('d-m-Y',strtotime(\Input::get('view_at')));
        //return $id;
        $data['dis'] = \DB::table('view_schedule_report')->where('ln_disburse_client_id','=',$id)->first();
//var_dump($data['dis']);exit;
        //re-calculate amount for Mortagate Loan
        $installPrinAmount = 0;
        if($data['dis']->interest_type_code=='ANT'){
            $tmpRate = 1-pow((1+$data['dis']->interest_rate/100),-$data['dis']->num_payment);
            $installPrinAmount = ($data['dis']->amount*$data['dis']->interest_rate/100)/$tmpRate;
            $installPrinAmount = \Currency::round($data['dis']->cp_currency_code,$installPrinAmount);
        }

        ($data['dis']->repayment_frequency_type_code == 'W')? $data['dis']->repayment_frequency_type_code = 'សប្ដាហ៍': $data['dis']->repayment_frequency_type_code ='ខែ';

        $data['result'] = Schedule::where('ln_disburse_client_id','=',$id)
            ->join('ln_schedule_dt', 'ln_schedule.id', '=', 'ln_schedule_dt.ln_schedule_id')->orderBy('index')->get();

// User action
        \Event::fire('user_action.report', array('rpt_schedule'));
        $rptFormat='Borey'; // Kra, Nikom

            $rptName='Repayment Schedule Borey';
            $rptExtension='.xlsx';

            $objReader = new \PHPExcel_Reader_Excel2007();
            $objPHPExcel=$objReader->load(storage_path('packages/loan/'.$rptName.$rptExtension));
            $objWorkSheet=$objPHPExcel->getActiveSheet();

            $companyName=Company::first();
            $office=Office::find(\UserSession::read()->sub_branch);

            // Header
            $objWorkSheet->getCell('A1')->setValue($companyName->kh_name);
            $objWorkSheet->getCell('A2')->setValue($companyName->en_name);
            $objWorkSheet->getCell('A3')->setValue('ការិយាល័យ៖ '.$office->kh_name.', ទូរស័ព្ទ៖ '.$office->telephone);
//            $objWorkSheet->getCell('A2')->setValue('ការិយាល័យ៖ '.$office->kh_name.', '.'អាសយដ្ឋាន៖ '.$office->kh_address.', ទូរស័ព្ទ៖ '.$office->telephone);

            // Page filter
            $objWorkSheet->getCell('A5')->setValue('លេខកូដ៖ '.$data['dis']->col_no.' ('.$data['dis']->account_type_code.')');
            $objWorkSheet->getCell('A6')->setValue('ឈ្មោះ៖ '.$data['dis']->ln_client_kh_name);

            $gender=($data['dis']->gender_code=='M'?'ប្រុស':'ស្រី');
            $objWorkSheet->getCell('A7')->setValue('ភេទ៖ '.$gender);

            $frequency=($data['dis']->repayment_frequency_type_name=='Weekly'?'សប្តាហ៍':'ខែ');
            $objWorkSheet->getCell('A8')->setValue('ប្រភេទការសង៖ '.$frequency);

            $objWorkSheet->getCell('A9')->setValue('រយៈពេលបង់៖ '.$data['dis']->num_installment.' '. $frequency);

//            $objWorkSheet->getCell('D4')->setValue('រំលស់ការ៖ '.$data['dis']->installment_frequency.' '.$frequency.'ម្តង');
            $objWorkSheet->getCell('D5')->setValue('រំលស់ដើម៖ '.$data['dis']->installment_principal_frequency.' វគ្គម្តង');
            $objWorkSheet->getCell('D6')->setValue('រំលស់ដើម៖ '.$data['dis']->installment_principal_percentage.' %');
            $objWorkSheet->getCell('D7')->setValue('អត្រាការប្រាក់៖ '.$data['dis']->interest_rate.' %');
            $objWorkSheet->getCell('D8')->setValue('ចំនួនលើកនៃកាបង់៖ '.$data['dis']->cycle);
            $objWorkSheet->getCell('D9')->setValue('អាសយដ្ឋាន៖ '.$data['dis']->address);

            $objWorkSheet->getCell('F5')->setValue('កាលបរិច្ឆេទទិញ៖'.date('d-m-Y',strtotime($data['dis']->ln_disburse_date)));
            $objWorkSheet->getCell('F6')->setValue('លេខប័ណ្ណបើកប្រាក់៖ '.substr($data['dis']->voucher_id,-6));
            if($data['dis']->cp_currency_code=='KHR'){
                $currency='រៀល';
            }elseif($data['dis']->cp_currency_code=='USD'){
                $currency='ដុល្លារ';
            }else{// THB
                $currency='បាត';
            }
            $objWorkSheet->getCell('F7')->setValue('ចំនួនទឹកប្រាក់៖ '.number_format($data['dis']->amount,2,'.',',').' '.$currency);
//        $objWorkSheet->getCell('F8')->setValue('សោហ៊ុយសេវា៖ ');
            $objWorkSheet->getCell('F8')->setValue('ចំនួនប្រាក់កក់៖ '.number_format($data['dis']->pay_down,2,'.',',').' '.$currency);

            // Content
            $count=count($data['result']);
            $objWorkSheet->insertNewRowBefore(12, $count);
            $objWorkSheet->removeRow(11, 2);
            foreach($data['result'] as $key=>$value){
                $rowNum=11+$key;

                //draft Schedule
                $tmpDate = $value->due_date;
                $tmpNumDay = $value->num_day;
                if(\Input::get('type')=='draft' and $data['dis']->installment_frequency >1){
                    if($data['dis']->repayment_frequency_type_name=='Weekly'){
                        if($key>0){
                            $a=\Carbon::createFromFormat('Y-m-d', $value->due_date);
                            $tmpDate = $a->subWeek();
                            if($key==1) $tmpNumDay = $value->num_day - 7;
                        }
                    }
                    if($data['dis']->repayment_frequency_type_name=='Monthly'){
                        if($key>0){
                            $a=\Carbon::createFromFormat('Y-m-d', $value->due_date);
                            $tmpDate = $a->subMonth();
                            if($key==1) $tmpNumDay = $value->num_day - 30;
                        }
                    }
                }
                $dueDate=\LookupValueList::getKhmerDay($tmpDate).' '.date('d-m-Y', strtotime($tmpDate));
                if($data['dis']->ln_perform_num_installment_can_closing == $key){
                    $styleArray=array(
                        'fill'=>array(
                            'type'=>\PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array('rgb' => '4288CE'),
                        )
                    );
//                $objWorkSheet->getStyle('A'.$rowNum)->getFill()->applyFromArray($styleArray);
                    $objWorkSheet->getStyle('A'.$rowNum)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
                    $objWorkSheet->getStyle('A'.$rowNum)->getFill()->getStartColor()->setARGB('4288CE');
                }
                $objWorkSheet->getCell('A'.$rowNum)->setValue($key);
                $objWorkSheet->getCell('B'.$rowNum)->setValue($dueDate);
                $objWorkSheet->getCell('C'.$rowNum)->setValue($tmpNumDay);
                $objWorkSheet->getCell('D'.$rowNum)->setValue($value->principal);
                $objWorkSheet->getCell('E'.$rowNum)->setValue($value->interest);
                if($data['dis']->interest_type_code=='ANT'){
                    if($key==0){
                        $objWorkSheet->getCell('F'.$rowNum)->setValue(0);
                    }else{
                        $objWorkSheet->getCell('F'.$rowNum)->setValue($installPrinAmount);
                    }

                }else{
                    $objWorkSheet->getCell('F'.$rowNum)->setValue('=D'.$rowNum.'+E'.$rowNum);
                }
                $objWorkSheet->getCell('G'.$rowNum)->setValue($value->balance);
            }

            // Add client name and disburse date to sign
            $objWorkSheet->getCell('F'.(17-2+$count))->setValue($data['dis']->ln_client_kh_name);
            $objWorkSheet->getCell('B'.(19-2+$count))->setValue('ថ្ងៃទី '.date('d-m-Y',strtotime($data['dis']->ln_disburse_date)));
            $objWorkSheet->getCell('F'.(19-2+$count))->setValue('ថ្ងៃទី '.date('d-m-Y',strtotime($data['dis']->ln_disburse_date)));


        // redirect output to client browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=UTF-8');
        header('Content-Disposition: attachment; filename="'.$rptName.' ['.$data['dis']->ln_disburse_client_id.']'.$rptExtension.'"');
//        header('Cache-Control: max-age=0'); // on PHPExcel
        header('Cache-Control: cache, must-revalidate'); // on Laravel Excel
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: '.\Carbon::now()->format('D, d M Y H:i:s'));
        header('Pragma: public');

        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('php://output');
        exit;

    }

}