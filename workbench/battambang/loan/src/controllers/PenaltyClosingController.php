<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/20/13
 * Time: 4:20 PM
 */

namespace Battambang\Loan;

use Input,
    Redirect,
    Request,
    View,
    DB,
    Config;
use Battambang\Cpanel\BaseController;
use UserSession;

class PenaltyClosingController extends BaseController
{

    public function index()
    {
        $item = array('Action', 'ID',  'Name');

        $data['table'] = \Datatable::table()
            ->addColumn($item) // these are the column headings to be shown
            ->setUrl(route('api.penalty_closing')) // this is the route where data will be retrieved
            ->setOptions('aLengthMenu', array(
                array('10', '25', '50', '100', '-1'),
                array('10', '25', '50', '100', 'All')
            ))
            ->setOptions("iDisplayLength", '10')// default show entries
            ->render('battambang/cpanel::layout.templates.template');
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.penalty_closing_index'), $data)
        );
    }

    public function create()
    {
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.penalty_closing_create'))
        );
    }

    public function edit($id)
    {
        try {
            $arr['row'] = PenaltyClosing::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.penalty_closing_edit'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.category.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function show($id)
    {
        try {
            $arr['row'] = PenaltyClosing::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.penalty_closing_show'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.penalty_closing.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function store()
    {
        $validation = $this->getValidationService('penalty_closing');
        if ($validation->passes()) {
            $data = new PenaltyClosing();
            $this->saveData($data);

            return Redirect::back()
                ->with('success', trans('battambang/loan::penalty_closing.create_success'));

        }
        return Redirect::back()->withInput()->withErrors($validation->getErrors());
    }

    public function update($id)
    {
        try {
            $validation = $this->getValidationService('penalty_closing');
            if ($validation->passes()) {
                $data = PenaltyClosing::findOrFail($id);
                $this->saveData($data);

                return Redirect::back()
                    ->with('success', trans('battambang/loan::penalty_closing.update_success'));
            }
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        } catch (\Exception $e) {
            return Redirect::route('loan.penalty_closing.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function destroy($id)
    {
        try {
            $data = PenaltyClosing::findOrFail($id);
            $data->delete();
            return Redirect::back()->with('success', trans('battambang/loan::penalty_closing.delete_success'));
        } catch (\Exception $e) {
            return Redirect::route('loan.penalty_closing.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    private function saveData($data)
    {

        $data->name = Input::get('name');
        $data->percentage_installment = Input::get('percentage_installment');
        $data->percentage_interest_remainder = Input::get('percentage_interest_remainder');

        $data->save();
    }

    public function getDatatable()
    {
        $item = array('id', 'name');
        $arr = DB::table('ln_penalty_closing');

        return \Datatable::query($arr)
            ->addColumn('action', function ($model) {
                return \Action::make()
                    ->edit(route('loan.penalty_closing.edit', $model->id))
                    ->delete(route('loan.penalty_closing.destroy', $model->id),'',$this->_checkStatus($model->id))
                    ->get();
            })
            ->showColumns($item)
            ->searchColumns($item)
            ->orderColumns($item)
            ->make();
    }

    private function _checkStatus($id){
        $data = Product::where('ln_penalty_closing_id','=',$id)->count();
        if($data > 0){
            return false;
        }
        return true;
    }

}