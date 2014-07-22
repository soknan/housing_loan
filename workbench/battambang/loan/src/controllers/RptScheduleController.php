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

        ($data['dis']->repayment_frequency_type_code == 'W')? $data['dis']->repayment_frequency_type_code = 'សប្ដាហ៍': $data['dis']->repayment_frequency_type_code ='ខែ';

        $data['result'] = Schedule::where('ln_disburse_client_id','=',$id)
            ->join('ln_schedule_dt', 'ln_schedule.id', '=', 'ln_schedule_dt.ln_schedule_id')->get();


        $rptFormat='Nikom'; // Kra, Nikom

        if($rptFormat=='Kra'){
            $rptName='Repayment Schedule Kra';
            $rptExtension='.xlsx';

            $objReader = new \PHPExcel_Reader_Excel2007();
            $objPHPExcel=$objReader->load(storage_path('packages/loan/'.$rptName.$rptExtension));
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
//        $objWorkSheet->getCell('F8')->setValue('សោហ៊ុយសេវា៖ ');
            $objWorkSheet->getCell('F8')->setValue('មន្រ្តីឥណទាន៖ '.$data['dis']->ln_staff_id.' | '.$data['dis']->ln_staff_kh_name);

            // Content
            $count=count($data['result']);
            $objWorkSheet->insertNewRowBefore(14, $count);
            $objWorkSheet->removeRow(13, 2);
            foreach($data['result'] as $key=>$value){
                $rowNum=13+$key;
                $dueDate=\LookupValueList::getKhmerDay($value->due_date).' '.date('d-m-Y', strtotime($value->due_date));
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
                $objWorkSheet->getCell('C'.$rowNum)->setValue($value->num_day);
                $objWorkSheet->getCell('D'.$rowNum)->setValue($value->principal);
                $objWorkSheet->getCell('E'.$rowNum)->setValue($value->interest);
                $objWorkSheet->getCell('F'.$rowNum)->setValue('=D'.$rowNum.'+E'.$rowNum);
                $objWorkSheet->getCell('G'.$rowNum)->setValue($value->balance);
            }

            // Add client name and disburse date to sign
            $objWorkSheet->getCell('F'.(19-2+$count))->setValue($data['dis']->ln_client_kh_name);
            $objWorkSheet->getCell('B'.(21-2+$count))->setValue('ថ្ងៃទី '.date('d-m-Y',strtotime($data['dis']->ln_disburse_date)));
            $objWorkSheet->getCell('F'.(21-2+$count))->setValue('ថ្ងៃទី '.date('d-m-Y',strtotime($data['dis']->ln_disburse_date)));

        }else{ // Nikom
            $rptName='Repayment Schedule Nikom';
            $rptExtension='.xlsx';

            $objReader = new \PHPExcel_Reader_Excel2007();
            $objPHPExcel=$objReader->load(storage_path('packages/loan/'.$rptName.$rptExtension));
            $objWorkSheet=$objPHPExcel->getActiveSheet();

            $companyName=Company::first()->kh_name;
            $office=Office::find(\UserSession::read()->sub_branch);

            // Header
            $objWorkSheet->getCell('A1')->setValue($companyName);
            $objWorkSheet->getCell('A2')->setValue('ការិយាល័យ៖ '.$office->kh_name.', '.'អាសយដ្ឋាន៖ '.$office->kh_address.', ទូរស័ព្ទ៖ '.$office->telephone);

            // Page filter
            $objWorkSheet->getCell('A4')->setValue('លេខកូដ៖ '.$data['dis']->ln_disburse_client_id.' ('.$data['dis']->account_type_code.')');
            $objWorkSheet->getCell('A5')->setValue('ឈ្មោះ៖ '.$data['dis']->ln_client_kh_name);

            $gender=($data['dis']->gender_code=='M'?'ប្រុស':'ស្រី');
            $objWorkSheet->getCell('A6')->setValue('ភេទ៖ '.$gender);

            $frequency=($data['dis']->repayment_frequency_type_name=='Weekly'?'សប្តាហ៍':'ខែ');
            $objWorkSheet->getCell('A7')->setValue('ប្រភេទការសង៖ '.$frequency);

            $objWorkSheet->getCell('A8')->setValue('រយៈពេលខ្ចី៖ '.$data['dis']->num_installment.' '. $frequency);

            $objWorkSheet->getCell('D4')->setValue('រំលស់ការ៖ '.$data['dis']->installment_frequency.' '.$frequency.'ម្តង');
            $objWorkSheet->getCell('D5')->setValue('រំលស់ដើម៖ '.$data['dis']->installment_principal_frequency.' វគ្គម្តង');
            $objWorkSheet->getCell('D6')->setValue('រំលស់ដើម៖ '.$data['dis']->installment_principal_percentage.' %');
            $objWorkSheet->getCell('D7')->setValue('អត្រាការប្រាក់៖ '.$data['dis']->interest_rate.' %');
            $objWorkSheet->getCell('D8')->setValue('ចំនួនលើកនៃការខ្ចី៖ '.$data['dis']->cycle);

            $objWorkSheet->getCell('F4')->setValue('កាលបរិច្ឆេទខ្ចី៖ '.date('d-m-Y',strtotime($data['dis']->ln_disburse_date)));
            $objWorkSheet->getCell('F5')->setValue('លេខប័ណ្ណបើកប្រាក់៖ '.substr($data['dis']->voucher_id,-6));
            if($data['dis']->cp_currency_code=='KHR'){
                $currency='រៀល';
            }elseif($data['dis']->cp_currency_code=='USD'){
                $currency='ដុល្លារ';
            }else{// THB
                $currency='បាត';
            }
            $objWorkSheet->getCell('F6')->setValue('ចំនួនទឹកប្រាក់៖ '.number_format($data['dis']->amount,2,'.',',').' '.$currency);
//        $objWorkSheet->getCell('F8')->setValue('សោហ៊ុយសេវា៖ ');
            $objWorkSheet->getCell('F7')->setValue('មន្រ្តីឥណទាន៖ '.$data['dis']->ln_staff_id.' | '.$data['dis']->ln_staff_kh_name);
            $objWorkSheet->getCell('F8')->setValue('អាសយដ្ឋាន៖ '.$data['dis']->address);

            // Content
            $count=count($data['result']);
            $objWorkSheet->insertNewRowBefore(11, $count);
            $objWorkSheet->removeRow(10, 2);
            foreach($data['result'] as $key=>$value){
                $rowNum=10+$key;
                $dueDate=\LookupValueList::getKhmerDay($value->due_date).' '.date('d-m-Y', strtotime($value->due_date));
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
                $objWorkSheet->getCell('C'.$rowNum)->setValue($value->num_day);
                $objWorkSheet->getCell('D'.$rowNum)->setValue($value->principal);
                $objWorkSheet->getCell('E'.$rowNum)->setValue($value->interest);
                $objWorkSheet->getCell('F'.$rowNum)->setValue('=D'.$rowNum.'+E'.$rowNum);
                $objWorkSheet->getCell('G'.$rowNum)->setValue($value->balance);
            }

            // Add client name and disburse date to sign
            $objWorkSheet->getCell('F'.(16-2+$count))->setValue($data['dis']->ln_client_kh_name);
            $objWorkSheet->getCell('B'.(18-2+$count))->setValue('ថ្ងៃទី '.date('d-m-Y',strtotime($data['dis']->ln_disburse_date)));
            $objWorkSheet->getCell('F'.(18-2+$count))->setValue('ថ្ងៃទី '.date('d-m-Y',strtotime($data['dis']->ln_disburse_date)));

        }

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