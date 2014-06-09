<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/20/13
 * Time: 4:20 PM
 */

namespace Battambang\Loan;

use Battambang\Loan\Facades\LookupValueList;
use Battambang\Loan\Libraries\LoanPerformance;
use Input,
    Redirect,
    Request,
    View,
    DB,
    Config;
use Battambang\Cpanel\BaseController;
use UserSession;

class RepaymentController extends BaseController
{

    public function index()
    {
        $item = array('Action', 'Loan Acc #', 'Client Name', 'Date', 'Type', 'Principal', 'Interest', 'Fee', 'Penalty', 'Total');
//        $data['btnAction'] = array('Add New' => route('loan.repayment.create'));
        $data['table'] = \Datatable::table()
            ->addColumn($item) // these are the column headings to be shown
            ->setUrl(route('api.repayment')) // this is the route where data will be retrieved
            ->setOptions('aLengthMenu', array(
                array('10', '25', '50', '100', '-1'),
                array('10', '25', '50', '100', 'All')
            ))
            ->setOptions("iDisplayLength", '10')// default show entries
            ->render('battambang/cpanel::layout.templates.template');
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.repayment_index'), $data)
        );
    }

    public function create()
    {
//        $data['disburseClient'] = $this->_getLoanAccount();
        $data['status'] = LookupValueList::getRepayStatus();
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.repayment_create'), $data)
        );
    }

    public function edit($id)
    {
        try {
//            $data['disburseClient'] = $this->_getLoanAccount();
            $data['status'] = LookupValueList::getRepayStatus();
            $data['row'] = Perform::where('id', '=', $id)->first();
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.repayment_edit'), $data)
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.repayment.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function show($id)
    {
        try {
            $arr['row'] = Perform::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.repayment_show'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.repayment.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function store()
    {
        $validation = $this->getValidationService('repayment');
        $perform = new LoanPerformance();
        $msg = '';
        $perform_date = \Carbon::createFromFormat('d-m-Y',Input::get('repayment_date'))->format('Y-m-d') ;
        //echo $perform_date; exit;
        $principal = Input::get('repayment_principal');
        $penalty = Input::get('repayment_penalty');
        $status = Input::get('repayment_status');
        $voucher_id = Input::get('repayment_voucher_id');

        if ($validation->passes()) {
            $data = $perform->get(Input::get('ln_disburse_client_id'), $perform_date);
            if($perform_date < $perform->_getLastPerform(Input::get('ln_disburse_client_id'))->activated_at){
                $error = 'Your Perform Date < Last Perform Date ('.$perform->_getLastPerform(Input::get('ln_disburse_client_id'))->activated_at.') ! ';
                return Redirect::back()->with('error',$error)->with('data', $data);
            }

            //$data = $perform->get(Input::get('ln_disburse_client_id'), $perform_date);
            // Fee
            if($data->_arrears['cur']['fee'] > 0){
                $data->error = 'Please repay fee !';
                $data->_repayment['cur']['type'] = 'fee';
                $perform->_activated_at = $data->_due['date'];
                $data->_arrears['cur']['principal'] = $data->_arrears['cur']['fee'];
                if(Input::has('confirm')){
                    $msg = 'Due Date = <strong>' . \Carbon::createFromFormat('Y-m-d',$data->_due['date'])->format('d-m-Y') . '</strong> ,</br> '
                        . 'Fee Amount = <strong>' . $data->_arrears['cur']['fee'] .'</strong>
                        <P>Note : ' . $data->error . '</P>';

                    return Redirect::back()
                        ->with('data', $data)
                        ->with('info', $msg);
                }

                if($data->_arrears['cur']['fee']!=$principal){
                    $data->error = 'Repayment Principal not equal with Fee !';
                    return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
                }

                $perform->repay($principal,$penalty,$status,$voucher_id);
                $msg = 'Due Date = <strong>' . $data->_repayment['cur']['date'] . '</strong> ,</br> '
                        . 'Fee Amount = <strong>' . $data->_repayment['cur']['fee'] .'</strong>
                        <P>Successful !</P>';
                $perform->save();

                return Redirect::back()
                    ->with('info',$msg)
                    ->with('success',trans('battambang/loan::repayment.create_success'));
            }

            //var_dump($data); exit;
            $tmp_repay = $data->_repayment['cur']['type'];
            $totalArrears = $data->_arrears['cur']['principal'] + $data->_arrears['cur']['interest'];
            $currency = Currency::where('id','=',$data->_disburse->cp_currency_id)->first();
            $pri_closing ='';
            $int_closing ='';
            //$pri_closing = ' ( Late : '.(($data->_new_due['principal']-$data->_due['principal'])+$data->_arrears['last']['principal']).', Cur Pri : '.$data->_due['principal'].' )';
            //$int_closing = ' ( Late : '.(($data->_new_due['interest']-$data->_due['interest'])+$data->_arrears['last']['interest']).', Cur Int : '.$data->_due['interest'].' )';
            $pri_closing = ' ( Late : '.($data->_arrears['cur']['principal'] - $data->_due['principal']).', Cur Pri : '.$data->_due['principal'].' )';
            $int_closing = ' ( Late : '.(($data->_arrears['cur']['interest'] - $data->_due['interest'])).', Cur Int : '.$data->_due['interest'].' )';
            if($status == 'closing'){
                if($data->_repayment['cur']['type'] != 'closing'){
                    if($totalArrears !=0){
                        $data->_arrears['cur']['principal'] = $data->_arrears['cur']['principal'] + $data->_due_closing['principal_closing'];
                        $data->_arrears['cur']['interest'] = $data->_arrears['cur']['interest'] + $data->_due_closing['interest_closing'] + $data->_accru_int;
                        $data->_repayment['cur']['type'] = $status;
                        $data->error ='Closing normal !.';
                        $pri_closing = ' ( Late : '.($data->_new_due['principal'] - $data->_due['principal'])
                            .', Cur Pri : '.$data->_due['principal'].', Closing : '.$data->_due_closing['principal_closing'].' )';
                        $int_closing = ' ( Late : '.($data->_new_due['interest'] - $data->_due['interest'])
                            .', Cur Int : '.$data->_due['interest'].', Closing : '.$data->_due_closing['interest_closing'].', Accrued Int : '.$data->_accru_int.' )';
                    }else{
                        //if($data->_repayment['last']['principal'] + $data->_repayment['last']['interest'] == 0 and $data->_arrears['cur']['penalty']==0){
                            $data->_arrears['cur']['principal'] = $data->_balance_principal;
                            $data->_arrears['cur']['interest'] = $perform->_getPenaltyClosing($data->_balance_interest) + $data->_accru_int;
                            $data->_repayment['cur']['type'] = $status;
                            $data->error = 'Closing after disburse date or after repay !.';

                            $pri_closing = ' ( Late : 0 , Closing : '.$data->_balance_principal.' )';
                            $int_closing = ' ( Late : 0 , Closing : '.$perform->_getPenaltyClosing($data->_balance_interest).', Accrued Int : '.$data->_accru_int.' )';
                        //}
                    }
                }
            }elseif(($data->_repayment['cur']['type'] == 'closing' or $data->_repayment['cur']['type'] == 'penalty') and $data->_arrears['cur']['penalty'] > 0){
                //$data->error ='Repay on Penalty !.';
                $data->_repayment['cur']['type'] = 'penalty';
            }else{
                $data->_repayment['cur']['type'] = 'normal';
            }



            if (Input::has('confirm')) {
                $msg = 'Due Date = <strong>' . \Carbon::createFromFormat('Y-m-d',$data->_due['date'])->format('d-m-Y') . '</strong> ,</br> '
                    . 'Pri Amount = <strong>' . $data->_arrears['cur']['principal'] .'</strong>'.$pri_closing.' , '
                    . 'Int Amount = <strong>' . $data->_arrears['cur']['interest'] .'</strong>'.$int_closing.'.</br>'
                    . 'Total Amount = <strong>' . ($data->_arrears['cur']['principal'] + $data->_arrears['cur']['interest']) .' '.$currency->code. '</strong> , '
                    . 'Penalty Amount = <strong>' . $data->_arrears['cur']['penalty'] . '</strong>.
                <P>Note : ' . $data->error . '</P>';

                return Redirect::back()
                    ->with('data', $data)
                    ->with('info', $msg);
            }

            $totalArrears = $data->_arrears['cur']['principal'] + $data->_arrears['cur']['interest'];

            if($penalty!=0){
                if(bccomp($totalArrears,$principal,4)==1 and ($data->_arrears['cur']['penalty'] > $penalty or bccomp($data->_arrears['cur']['penalty'],$penalty)== 0) ){
                    //$data->__construct();
                    $data->error = 'Please Repay Principal and Interest Before Repay Penalty!';
                    $data->_repayment['cur']['type'] = $status;
                    return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
                }
            }

            if(bccomp($principal,$totalArrears,4) == 1){
                $data->__construct();
                $data->error = 'Your Repay Amount > Arrears Principal. Please Confirm before save.';
                $data->_repayment['cur']['type'] = $status;
                return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
            }

            if(bccomp($penalty,$data->_arrears['cur']['penalty'],4)==1){
                $data->__construct();
                $data->error = 'Your Penalty Amount > Arrears Penalty.';
                $data->_repayment['cur']['type'] = $status;
                return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
            }
            if(empty($voucher_id)){
                $data->error = 'Your Voucher ID is null.';
                $data->_repayment['cur']['type'] = $status;
                return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
            }
            if($data->_repayment['cur']['type'] == 'closing'){
                if($principal != $totalArrears){
                    $data->error = 'Your Repay amount not equal with Principal amount. Your current status in Closing !.';
                    $data->_repayment['cur']['type'] = $status;
                    return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
                }
            }
            if($status == 'penalty'){
                if($data->_repayment['cur']['type'] == 'normal'){
                    $data->error = 'Your Current Account is not Closing. Please Confirm before save.';
                    $data->_repayment['cur']['type'] = $status;
                    return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
                }else{
                    if($data->_arrears['cur']['penalty'] == 0){
                        $data->error = 'Your Current Account no Penalty. Please Confirm before save.';
                        $data->_repayment['cur']['type'] = $status;
                        return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
                    }
                }
            }else{
                if($principal == 0 and $data->_arrears['cur']['penalty'] == 0){
                    $data->error = 'Your Current Repay is 0. Please Confirm before save !.';
                    $data->_repayment['cur']['type'] = $status;
                    return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
                }
            }

            if(($tmp_repay == 'closing' or $tmp_repay == 'penalty')){
                if($status!='penalty'){
                    $data->error ='Your Current Account Already Closing, But you still have penalty. You must choose Penalty status.';
                    $data->_repayment['cur']['type'] = 'penalty';
                    return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
                }
            }

            $perform->repay(
                Input::get('repayment_principal'),
               $penalty,
                Input::get('repayment_status'),
                Input::get('repayment_voucher_id')
            );

            //var_dump($data); exit;
            $classify = ProductStatus::where('id','=',$data->_current_product_status)->first();

            $msg = 'Repay Date = <strong>' . \Carbon::createFromFormat('Y-m-d',$data->_repayment['cur']['date'])->format('d-m-Y') . '</strong>, '
                . 'Repay Principal Amount = <strong>' . $data->_repayment['cur']['principal'] . '</strong>, '
                . 'Repay Interest Amount = <strong>' . $data->_repayment['cur']['interest'] . '</strong>, '
                . 'Repay Total Amount = <strong>' . ($data->_repayment['cur']['principal'] + $data->_repayment['cur']['interest']) .$currency->code. '</strong>, '
                . 'Repay Penalty Amount = <strong>' . $data->_repayment['cur']['penalty'] . '</strong>'
                .'<p>Repay Status : '.$data->_repayment['cur']['type'].', Classify : '.$classify->code.'</p>'
               ;
            $perform->save();

            return Redirect::back()
                ->with('info',$msg)
                ->with('success',trans('battambang/loan::repayment.create_success'));
        }
        return Redirect::back()->withInput()->withErrors($validation->getErrors());
    }

    public function update($id)
    {
        try {
            $validation = $this->getValidationService('repayment');
            $perform = new LoanPerformance();
            $msg = '';
            $perform_date = \Carbon::createFromFormat('d-m-Y',Input::get('repayment_date'))->toDateString();
            $principal = Input::get('repayment_principal');
            $penalty = Input::get('repayment_penalty');
            $status = Input::get('repayment_status');
            $voucher_id = Input::get('repayment_voucher_id');


            if ($validation->passes()) {
                $curData = Perform::where('id','=',$id)->get()->toArray();
                $perform->delete($id);
                if($perform_date < $perform->_getLastPerform(Input::get('ln_disburse_client_id'))->activated_at){
                    $error = 'Your Perform Date < Last Perform Date ('.$perform->_getLastPerform(Input::get('ln_disburse_client_id'))->activated_at.') ! ';
                    return Redirect::back()->withInput()->with('error',$error);
                }

                $data = $perform->get(Input::get('ln_disburse_client_id'), $perform_date);
                //var_dump($data); exit;
                // Fee
                if($data->_arrears['cur']['fee'] > 0){
                    $data->error = 'Please repay fee !';
                    $data->_repayment['cur']['type'] = 'fee';
                    $perform->_activated_at = $data->_due['date'];
                    $data->_arrears['cur']['principal'] = $data->_arrears['cur']['fee'];
                    if(Input::has('confirm')){
                        $msg = 'Due Date = <strong>' . \Carbon::createFromFormat('Y-m-d',$data->_due['date'])->format('d-m-Y') . '</strong> ,</br> '
                            . 'Fee Amount = <strong>' . $data->_arrears['cur']['fee'] .'</strong>
                        <P>Note : ' . $data->error . '</P>';

                        unset($curData['created_at']);
                        unset($curData['updated_at']);
                        Perform::insert($curData);
                        return Redirect::back()
                            ->with('data', $data)
                            ->with('info', $msg);
                    }
                    //var_dump($data); exit;
                    if($data->_arrears['cur']['fee']!=$principal){
                        $data->error = 'Repayment Principal not equal with Fee !';
                        return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
                    }

                    $perform->repay($principal,$penalty,$status,$voucher_id);
                    $msg = 'Due Date = <strong>' . $data->_repayment['cur']['date'] . '</strong> ,</br> '
                        . 'Fee Amount = <strong>' . $data->_repayment['cur']['fee'] .'</strong>
                        <P>Successful !</P>';
                    $perform->save();

                    return Redirect::back()
                        ->with('info',$msg)
                        ->with('success',trans('battambang/loan::repayment.create_success'));
                }

                $tmp_repay = $data->_repayment['cur']['type'];
                $totalArrears = $data->_arrears['cur']['principal'] + $data->_arrears['cur']['interest'];
                $currency = Currency::where('id','=',$data->_disburse->cp_currency_id)->first();
                $pri_closing ='';
                $int_closing ='';
                $pri_closing = ' ( Late : '.(($data->_new_due['principal']-$data->_due['principal'])+$data->_arrears['last']['principal']).' )';
                $int_closing = ' ( Late : '.(($data->_new_due['interest']-$data->_due['interest'])+$data->_arrears['last']['interest']).' )';
                if($status == 'closing'){
                    if($data->_repayment['cur']['type'] != 'closing'){
                        if($totalArrears !=0){
                            $data->_arrears['cur']['principal'] = $data->_arrears['cur']['principal'] + $data->_due_closing['principal_closing'];
                            $data->_arrears['cur']['interest'] = $data->_arrears['cur']['interest'] + $data->_due_closing['interest_closing'];
                            $data->_repayment['cur']['type'] = $status;
                            $data->error ='Closing normal !.';
                            $pri_closing = ' ( Late : '.($data->_new_due['principal'] - $data->_due['principal']).', Closing : '.$data->_due_closing['principal_closing'].' )';
                            $int_closing = ' ( Late : '.($data->_new_due['interest'] - $data->_due['interest']).', Closing : '.$data->_due_closing['interest_closing'].' )';
                        }else{
                            if($data->_repayment['last']['principal'] + $data->_repayment['last']['interest'] == 0 and $data->_arrears['cur']['penalty']==0){
                                $data->_arrears['cur']['principal'] = $data->_balance_principal;
                                $data->_arrears['cur']['interest'] = $perform->_getPenaltyClosing($data->_balance_interest);
                                $data->_repayment['cur']['type'] = $status;
                                $data->error = 'Closing after disburse date or after repay !.';

                                $pri_closing = ' ( Late : 0 , Closing : '.$data->_balance_principal.' )';
                                $int_closing = ' ( Late : 0 , Closing : '.$perform->_getPenaltyClosing($data->_balance_interest).' )';
                            }
                        }
                    }
                }elseif(($data->_repayment['cur']['type'] == 'closing' or $data->_repayment['cur']['type'] == 'penalty') and $data->_arrears['cur']['penalty']>0){
                    //$data->error ='Repay on Penalty !.';
                    $data->_repayment['cur']['type'] = 'penalty';
                }else{
                    $data->_repayment['cur']['type'] = 'normal';
                }


                if (Input::has('confirm')) {
                    $msg = 'Due Date = <strong>' . \Carbon::createFromFormat('Y-m-d',$data->_due['date'])->format('d-m-Y') . '</strong> ,</br> '
                        . 'Pri Amount = <strong>' . $data->_arrears['cur']['principal'] .'</strong>'.$pri_closing.' , '
                        . 'Int Amount = <strong>' . $data->_arrears['cur']['interest'] .'</strong>'.$int_closing.'.</br>'
                        . 'Total Amount = <strong>' . ($data->_arrears['cur']['principal'] + $data->_arrears['cur']['interest']) .' '.$currency->code. '</strong> , '
                        . 'Penalty Amount = <strong>' . $data->_arrears['cur']['penalty'] . '</strong>.
                <P>Note : ' . $data->error . '</P>';

                    unset($curData['created_at']);
                    unset($curData['updated_at']);
                    Perform::insert($curData);
                    return Redirect::back()
                        ->with('data', $data)
                        ->with('info', $msg);
                }

                $totalArrears = $data->_arrears['cur']['principal'] + $data->_arrears['cur']['interest'];
                if($penalty!=0){
                    if(bccomp($totalArrears,$principal,4)==1 and ($data->_arrears['cur']['penalty'] > $penalty or bccomp($data->_arrears['cur']['penalty'],$penalty)== 0) ){
                        //$data->__construct();
                        $data->error = 'Please Repay Principal and Interest Before Repay Penalty!';
                        $data->_repayment['cur']['type'] = $status;
                        return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
                    }
                }
                if(bccomp($principal,$totalArrears,4) == 1){
                    $data->__construct();
                    $data->error = 'Your Repay Amount > Arrears Principal. Please Confirm before save.';
                    $data->_repayment['cur']['type'] = $status;
                    return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
                }
                if(bccomp($penalty,$data->_arrears['cur']['penalty'],4)==1){
                    $data->__construct();
                    $data->error = 'Your Penalty Amount > Arrears Penalty.';
                    $data->_repayment['cur']['type'] = $status;
                    return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
                }
                if(empty($voucher_id)){
                    $data->error = 'Your Voucher ID is null.';
                    $data->_repayment['cur']['type'] = $status;
                    return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
                }
                if($data->_repayment['cur']['type'] == 'finish'){
                    if($principal != $totalArrears){
                        $data->error = 'Your Repay amount not equal with Principal amount. Your current status in finish !.';
                        $data->_repayment['cur']['type'] = $status;
                        return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
                    }
                }
                if($status == 'penalty'){
                    if($data->_repayment['cur']['type'] == 'normal'){
                        $data->error = 'Your Current Account is not finish. Please Confirm before save.';
                        $data->_repayment['cur']['type'] = $status;
                        return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
                    }else{
                        if($data->_arrears['cur']['penalty'] == 0){
                            $data->error = 'Your Current Account no Penalty. Please Confirm before save.';
                            $data->_repayment['cur']['type'] = $status;
                            return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
                        }
                    }
                }else{
                    if($principal == 0 and $data->_arrears['cur']['penalty']==0){
                        $data->error = 'Your Current Repay is 0. Please Confirm before save !.';
                        $data->_repayment['cur']['type'] = $status;
                        return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
                    }
                }

                if(($tmp_repay == 'closing' or $tmp_repay == 'penalty')){
                    if($status!='penalty'){
                        $data->error ='Your Current Account Already Closing, But you still have penalty. You must choose Penalty status.';
                        $data->_repayment['cur']['type'] = 'penalty';
                        return Redirect::back()->withInput()->with('data', $data)->with('error',$data->error);
                    }
                }

                $perform->repay(
                    Input::get('repayment_principal'),
                    Input::get('repayment_penalty'),
                    Input::get('repayment_status'),
                    Input::get('repayment_voucher_id')
                );
                //var_dump($data); exit;
                $classify = ProductStatus::where('id','=',$data->_current_product_status)->first();

                $msg = 'Repay Date = <strong>' . \Carbon::createFromFormat('Y-m-d',$data->_repayment['cur']['date'])->format('d-m-Y') . '</strong>, '
                    . 'Repay Principal Amount = <strong>' . $data->_repayment['cur']['principal'] . '</strong>, '
                    . 'Repay Interest Amount = <strong>' . $data->_repayment['cur']['interest'] . '</strong>, '
                    . 'Repay Total Amount = <strong>' . ($data->_repayment['cur']['principal'] + $data->_repayment['cur']['interest']) .$currency->code. '</strong>, '
                    . 'Repay Penalty Amount = <strong>' . $data->_repayment['cur']['penalty'] . '</strong>'
                    .'<p>Repay Status : '.$data->_repayment['cur']['type'].', Classify : '.$classify->code.'</p>'
                ;

                $perform->save();

                return Redirect::back()
                    ->withInput()
                    ->with('info',$msg)
                    ->with('success', trans('battambang/loan::repayment.update_success'));
            }
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        } catch (\Exception $e) {
            return Redirect::route('loan.repayment.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function destroy($id)
    {
        try {
            $data = Perform::findOrFail($id);
            $data->delete();
            return Redirect::back()->with('success', trans('battambang/loan::repayment.delete_success'));
        } catch (\Exception $e) {
            return Redirect::route('loan.repayment.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    private function saveData($data)
    {
        $data->name = Input::get('name');
        $data->des = Input::get('des');
        $data->save();
    }


    public function getDatatable()
    {
        $item = array('repayment_date', 'repayment_type', 'repayment_principal', 'repayment_interest', 'repayment_fee', 'repayment_penalty');
        $arr = DB::table('ln_perform')->where('perform_type', '=', 'repayment')->orderBy('activated_at', 'DESC');

        return \Datatable::query($arr)
            ->addColumn('action', function ($model) {
                //return '';
                return \Action::make()
                    ->edit(route('loan.repayment.edit', $model->id), $this->_checkAction($model->id, $model->ln_disburse_client_id))
                    ->delete(route('loan.repayment.destroy', $model->id), '', $this->_checkAction($model->id, $model->ln_disburse_client_id))
                    ->get();
            })
            ->addColumn('ln_disburse_client_id', function($model){
                    return ($model->ln_disburse_client_id);
                })
            ->addColumn('client_name', function($model){
                    $client=ClientLoan::find(substr($model->ln_disburse_client_id, 0, 5).substr($model->ln_disburse_client_id, 12, 4));
                    $clientName=$client->kh_last_name.' '.$client->kh_first_name;
                    return ($clientName);
                })
            ->showColumns($item)
            ->addColumn('total', function($model){
                    return number_format(($model->repayment_principal+$model->repayment_interest+$model->repayment_fee+$model->repayment_penalty), 2);
                })
            ->searchColumns($item)
            ->orderColumns($item)
            ->make();
    }

//    private function _getLoanAccount()
//    {
//        $perform = array('');
//        foreach (Perform::all() as $row) {
//            $perform[] = $row->ln_disburse_client_id;
//        }
//        $data = DB::table('view_disburse_client')->whereIn('id',$perform)->orderBy('id', 'desc')->get();
//        $arr = array();
//        foreach ($data as $row) {
//            $arr[$row->id] = $row->id . ' | ' . $row->client_kh_name . ' | ' . date('d-m-Y', strtotime($row->disburse_date));
//        }
//        return $arr;
//    }

    private function _checkAction($id, $disburse)
    {
        $data = Perform::where('ln_disburse_client_id', '=', $disburse)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->first();
        if ($data->id == $id) {
            return true;
        }
        return false;
    }

}