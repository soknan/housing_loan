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

class PenaltyController extends BaseController
{

    public function index()
    {
        $item = array('Action', 'ID', 'Code', 'Name');

        $data['table'] = \Datatable::table()
            ->addColumn($item) // these are the column headings to be shown
            ->setUrl(route('api.penalty')) // this is the route where data will be retrieved
            ->setOptions('aLengthMenu', array(
                array('10', '25', '50', '100', '-1'),
                array('10', '25', '50', '100', 'All')
            ))
            ->setOptions("iDisplayLength", '10')// default show entries
            ->render('battambang/cpanel::layout.templates.template');
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.penalty_index'), $data)
        );
    }

    public function create()
    {
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.penalty_create'))
        );
    }

    public function edit($id)
    {
        try {
            $arr['row'] = Penalty::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.penalty_edit'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.category.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function show($id)
    {
        try {
            $arr['row'] = Penalty::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.penalty_show'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.penalty.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function store()
    {
        $validation = $this->getValidationService('penalty');
        if ($validation->passes()) {
            $data = new Penalty();
            $this->saveData($data);

            return Redirect::back()
                ->with('success', trans('battambang/loan::penalty.create_success'));

        }
        return Redirect::back()->withInput()->withErrors($validation->getErrors());
    }

    public function update($id)
    {
        try {
            $validation = $this->getValidationService('penalty');
            if ($validation->passes()) {
                $data = Penalty::findOrFail($id);
                $this->saveData($data);

                return Redirect::back()
                    ->with('success', trans('battambang/loan::penalty.update_success'));
            }
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        } catch (\Exception $e) {
            return Redirect::route('loan.penalty.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function destroy($id)
    {
        try {
            $data = Penalty::findOrFail($id);
            $data->delete();
            return Redirect::back()->with('success', trans('battambang/loan::penalty.delete_success'));
        } catch (\Exception $e) {
            return Redirect::route('loan.penalty.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    private function saveData($data)
    {
        $data->name = Input::get('name');
        $data->amount = Input::get('amount');
        $data->ln_lv_penalty_type = Input::get('ln_lv_penalty_type');
        $data->grace_period = Input::get('grace_period');
        $data->ln_lv_calculate_type = Input::get('ln_lv_calculate_type');
        $data->ln_lv_percentage_of = Input::get('ln_lv_percentage_of');

        $data->save();
    }

    public function getDatatable()
    {
        $item = array('id', 'name', 'amount');
        $arr = DB::table('ln_penalty');

        return \Datatable::query($arr)
            ->addColumn('action', function ($model) {
                return \Action::make()
                    ->edit(route('loan.penalty.edit', $model->id))
                    ->delete(route('loan.penalty.destroy', $model->id),'',$this->_checkStatus($model->id))
                    ->get();
            })
            ->showColumns($item)
            ->searchColumns($item)
            ->orderColumns($item)
            ->make();
    }

    private function _checkStatus($id){
        $data = Product::where('ln_penalty_id','=',$id)->count();
        if($data > 0){
            return false;
        }
        return true;
    }

}