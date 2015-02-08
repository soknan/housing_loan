<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/20/13
 * Time: 4:20 PM
 */

namespace Battambang\Cpanel;

use Battambang\Cpanel\Libraries\EmptyClass;
use Battambang\Cpanel\Validators\WorkDayValidator;
use Input,
    Redirect,
    Request,
    View,
    DB,
    Config,
    Action;

class WorkDayController extends BaseController
{

    public function index()
    {
        $item = array('Action', 'ID', 'Work Week', 'Work Month', 'Work Time', 'Activated At');
//        $data['btnAction'] = array('Add New' => route('cpanel.workday.create'));
        $data['table'] = \Datatable::table()
            ->addColumn($item) // these are the column headings to be shown
            ->setUrl(route('api.workday')) // this is the route where data will be retrieved
            ->setOptions('aLengthMenu', array(
                array(10, 25, 50, 100),
                array(10, 25, 50, 100)
            ))
            ->setOptions("sScrollY",300)
            ->setOptions("iDisplayLength", 10)// default show entries
            ->render('battambang/cpanel::layout.templates.template');
        return $this->renderLayout(
            View::make(Config::get('battambang/cpanel::views.workday_index'), $data)
        );
    }

    public function create()
    {
        $data['form_action'] = route('cpanel.workday.store');
        $data['form_method'] = 'post';

        $form = new EmptyClass();
        $form->activated_at = date('Y-m-d');

        $data['form'] = $form;
        return $this->renderLayout(
            View::make('battambang/cpanel::workday.form', $data)
//            View::make(Config::get('battambang/cpanel::views.workday_create'), $data)
        );
    }

    public function edit($id)
    {
        try {
//            $arr['row'] = WorkDay::findOrFail($id);

            $data['form_action'] = route('cpanel.workday.update', $id);
            $data['form_method'] = 'put';

            $data['form'] = WorkDay::findOrFail($id);
            return $this->renderLayout(
                View::make('battambang/cpanel::workday.form', $data)
//                View::make(Config::get('battambang/cpanel::views.workday_edit'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('cpanel.workday.index')
                ->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function show($id)
    {
        try {
            $arr['row'] = WorkDay::findOrFail($id);
            return $this->renderLayout(
                View::make('battambang/cpanel::workday.show', $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('cpanel.workday.index')
                ->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function store()
    {
        $validator = WorkDayValidator::make();
        if ($validator->passes()) {

            $inputs = $validator->getInputs();

            $data = new WorkDay();
            $this->saveData($data, $inputs);

            return Redirect::back()
                ->with('success', trans('battambang/cpanel::workday.create_success'));
        }
        return Redirect::back()
            ->withInput()
            ->withErrors($validator->instance());
    }

    public function update($id)
    {
        try {
            $validator = WorkDayValidator::make();
            if ($validator->passes()) {

                $inputs = $validator->getInputs();

                $data = WorkDay::findOrFail($id);
                $this->saveData($data, $inputs);

                return Redirect::back()
                    ->with('success', trans('battambang/cpanel::workday.update_success'));
            }

            return Redirect::back()
                ->withInput()
                ->withErrors($validator->instance());

        } catch (\Exception $e) {
            return Redirect::route('cpanel.workday.index')
                ->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function destroy($id)
    {
        try {
            WorkDay::where('id', '=', $id)->delete();
            return Redirect::back()->with('success', trans('battambang/cpanel::workday.delete_success'));
        } catch (\Exception $e) {
            return Redirect::route('cpanel.workday.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    private function saveData($data, $inputs)
    {
        $data->work_week = $inputs['work_week'];
        $data->work_month = $inputs['work_month'];
        $data->work_time = $inputs['work_time'];
        $data->activated_at = $inputs['activated_at'];
        $data->save();
    }

    public function getDatatable()
    {
        $item = array('id', 'work_week', 'work_month', 'work_time', 'activated_at');
        $arr = DB::table('cp_workday');

        return \Datatable::query($arr)
            ->addColumn(
                'action',
                function ($model) {

                    return Action::make()
                        ->edit(route('cpanel.workday.edit', $model->id))
                        ->delete(route('cpanel.workday.destroy', $model->id), $model->id)
//                    ->show(route('cpanel.workday.show', $model->id))
                        ->get();
                }
            )
            ->showColumns($item)
            ->searchColumns($item)
            ->orderColumns($item)
            ->make();
    }
}