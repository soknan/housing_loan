<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/20/13
 * Time: 4:20 PM
 */

namespace Battambang\Loan;

use Battambang\Cpanel\BaseController;
use Config;
use DB;
use Input;
use Redirect;
use Request;
use UserSession;
use View;

class ProductController extends BaseController
{
    public function index()
    {
        $item = array('Action', 'ID', 'Product Name','Category',  'Start Date', 'End Date','Currency','Account Type');
//        $data['btnAction'] = array('Add New' => route('loan.product.create', $id));
        $data['table'] = \Datatable::table()
            ->addColumn($item) // these are the column headings to be shown
            ->setUrl(route('api.product')) // this is the route where data will be retrieved
            ->setOptions('aLengthMenu', array(
                array('10', '25', '50', '100', '-1'),
                array('10', '25', '50', '100', 'All')
            ))
            ->setOptions("iDisplayLength", '10')// default show entries
            ->render('battambang/cpanel::layout.templates.template');
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.product_index'), $data)
        );
    }

    public function create()
    {
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.product_create'))
        );

    }

    public function edit($id)
    {
        try {
            $arr = array();
            $arr['row'] = Product::find($id);
            $arr['row']->cp_currency_id_arr = json_decode($arr['row']->cp_currency_id_arr);
            $arr['row']->ln_lv_account_type_arr = json_decode($arr['row']->ln_lv_account_type_arr);

            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.product_edit'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::back()->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function show($id)
    {
        try {
            $arr['row'] = Product::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.product_show'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.product.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function store()
    {

        $validation = $this->getValidationService('product');
        if ($validation->passes()) {

            $data = new Product();
            $this->saveData($data);

            return Redirect::back()
                ->with('success', trans('battambang/loan::product.create_success'));
        }
        return Redirect::back()
            ->withInput(Input::except('ln_lv_account_type_arr','cp_currency_id_arr','ln_fund_id_arr'))
            ->withErrors($validation->getErrors());
    }

    public function update($id)
    {
        try {
            $validation = $this->getValidationService('product');

            if ($validation->passes()) {
                $data = Product::findOrFail($id);
                $this->saveData($data);

                return Redirect::back()
                    ->with('success', trans('battambang/loan::product.update_success'));
            }
            return Redirect::back()->withInput(Input::except('ln_lv_account_type_arr','cp_currency_id_arr','ln_fund_id_arr'))->withErrors($validation->getErrors());
        } catch (\Exception $e) {
            return Redirect::route('loan.product.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function destroy($id)
    {
        try {
//            Product::find($id)->delete();

            $data = Product::findOrFail($id);
            $data->delete();

            return Redirect::back()->with('success', trans('battambang/loan::product.delete_success'));
        } catch (\Exception $e) {
            return Redirect::route('loan.product.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    private function saveData($data)
    {
        $data->ln_category_id = Input::get('ln_category_id');
        $data->name = Input::get('name');
        $data->start_date = \Carbon::createFromFormat('d-m-Y',Input::get('start_date'))->toDateString();
        $data->end_date = \Carbon::createFromFormat('d-m-Y',Input::get('end_date'))->toDateString();
        $data->ln_lv_account_type_arr = json_encode(Input::get('ln_lv_account_type_arr'));
        $data->cp_currency_id_arr = json_encode(Input::get('cp_currency_id_arr'));
        $data->ln_lv_repay_frequency = Input::get('ln_lv_repay_frequency');
        $data->min_installment = Input::get('min_installment');
        $data->max_installment = Input::get('max_installment');
        $data->default_installment = Input::get('default_installment');
        $data->ln_lv_holiday_rule = Input::get('ln_lv_holiday_rule');
        $data->ln_lv_interest_type = Input::get('ln_lv_interest_type');
        $data->min_interest = Input::get('min_interest');
        $data->max_interest = Input::get('max_interest');
        $data->default_interest = Input::get('default_interest');
        $data->ln_lv_loan_amount_type = Input::get('ln_lv_loan_amount_type');
        $data->min_amount = Input::get('min_amount');
        $data->max_amount = Input::get('max_amount');
        $data->default_amount = Input::get('default_amount');
//        $data->ln_exchange_id = Input::get('ln_exchange_id');
        $data->ln_fee_id = Input::get('ln_fee_id');
        $data->ln_penalty_id = Input::get('ln_penalty_id');
        $data->ln_penalty_closing_id = Input::get('ln_penalty_closing_id');
        $data->ln_fund_id_arr = json_encode(Input::get('ln_fund_id_arr'));
        $data->des = Input::get('des');
        $data->save();
    }

//    private function getData()
//    {
//        return array(
//            'ln_category_id' => Input::get('ln_category_id'),
//            'name' => Input::get('name'),
//            'start_date' => Input::get('start_date'),
//            'end_date' => Input::get('end_date'),
//            'ln_lv_account_type_arr' => json_encode(Input::get('ln_lv_account_type_arr')),
//            'ln_currency_id_arr' => json_encode(Input::get('ln_currency_id_arr')),
//            'ln_lv_repay_frequency' => Input::get('ln_lv_repay_frequency'),
//            'min_installment' => Input::get('min_installment'),
//            'max_installment' => Input::get('max_installment'),
//            'default_installment' => Input::get('default_installment'),
//            'ln_lv_holiday_rule' => Input::get('ln_lv_holiday_rule'),
//            'ln_lv_interest_type' => Input::get('ln_lv_interest_type'),
//            'min_interest' => Input::get('min_interest'),
//            'max_interest' => Input::get('max_interest'),
//            'default_interest' => Input::get('default_interest'),
//            'ln_lv_loan_amount_type' => Input::get('ln_lv_loan_amount_type'),
//            'min_amount' => Input::get('min_amount'),
//            'max_amount' => Input::get('max_amount'),
//            'default_amount' => Input::get('default_amount'),
//            'ln_fee_id' => Input::get('ln_fee_id'),
//            'ln_penalty_id' => Input::get('ln_penalty_id'),
//            'ln_penalty_closing_id' => Input::get('ln_penalty_closing_id'),
//            'ln_fund_id_arr' => json_encode(Input::get('ln_fund_id_arr')),
//            'des' => Input::get('des'),
//        );
//    }

    public function getDatatable()
    {
        $item = array('id',  'product_name', 'category_name','start_date', 'end_date','cp_currency_id_arr','ln_lv_account_type_arr');
        $arr = DB::table('view_product');

        return \Datatable::query($arr)
            ->addColumn('action', function ($model) {
                $model->cp_currency_id_arr = $this->_getCurrecy(json_decode($model->cp_currency_id_arr));
                $model->ln_fund_id_arr = $this->_getFund(json_decode($model->ln_fund_id_arr));
                $model->ln_lv_account_type_arr = $this->_jsonLookup(json_decode($model->ln_lv_account_type_arr));
                return \Action::make()
                    ->edit(route('loan.product.edit', $model->id))
                    ->delete(route('loan.product.delete', $model->id),'',$this->_checkStatus($model->id))
                    ->get();
            })
            ->showColumns($item)
            ->searchColumns($item)
            ->orderColumns($item)
            ->make();
    }

    private function _getCurrecy($arr){
        $tmp='';
        $data = DB::select("select * from cp_currency where id IN('" . implode("','", $arr) . "')");
        foreach ($data as $row) {
            $tmp.= $row->code.',';

        }
        return substr($tmp,0,-1);
    }

    private function _getFund($arr){
        $tmp='';
        $data = DB::select("select * from ln_fund where id IN('" . implode("','", $arr) . "')");
        foreach ($data as $row) {
            $tmp.= $row->name.',';

        }
        return substr($tmp,0,-1);
    }

    private  function _jsonLookup($arr){
        $tmp='';
        $data = DB::select("select * from ln_lookup
            inner join ln_lookup_value on ln_lookup.id = ln_lookup_value.ln_lookup_id
            where ln_lookup_value.id IN('" . implode("','", $arr ) . "')");
        foreach ($data as $row) {
            $tmp.= $row->name.',';
        }
        return substr($tmp,0,-1);
    }

    private function _checkStatus($id){
        $data = Disburse::where('ln_product_id','=',$id)->count();
        if($data >0){
            return false;
        }
        return true;
    }

}