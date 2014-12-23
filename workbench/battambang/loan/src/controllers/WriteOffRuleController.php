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

class WriteOffRuleController extends BaseController
{

    public function index()
    {
        $item = array('Action', 'ID', 'Number Of Day', 'Activated At');

        $data['table'] = \Datatable::table()
            ->addColumn($item) // these are the column headings to be shown
            ->setUrl(route('api.write_off_rule')) // this is the route where data will be retrieved
            ->setOptions('aLengthMenu', array(
                array(10, 25, 50, 100, '-1'),
                array(10, 25, 50, 100, 'All')
            ))
            ->setOptions("iDisplayLength", 10)// default show entries
            ->render('battambang/cpanel::layout.templates.template');
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.write_off_rule_index'), $data)
        );
    }

    public function create()
    {
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.write_off_rule_create'))
        );
    }

    public function edit($id)
    {
        try {
            $arr['row'] = WriteOffRule::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.write_off_rule_edit'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.category.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function show($id)
    {
        try {
            $arr['row'] = WriteOffRule::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.write_off_rule_show'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.write_off_rule.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function store()
    {
        $validation = $this->getValidationService('write_off_rule');
        if ($validation->passes()) {
            $data = new WriteOffRule();
            $this->saveData($data);

            return Redirect::back()
                ->with('success', trans('battambang/loan::write_off_rule.create_success'));

        }
        return Redirect::back()->withInput()->withErrors($validation->getErrors());
    }

    public function update($id)
    {
        try {
            $validation = $this->getValidationService('write_off_rule');
            if ($validation->passes()) {
                $data = WriteOffRule::findOrFail($id);
                $this->saveData($data);

                return Redirect::back()
                    ->with('success', trans('battambang/loan::write_off_rule.update_success'));
            }
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        } catch (\Exception $e) {
            return Redirect::route('loan.write_off_rule.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function destroy($id)
    {
        try {
            $data = WriteOffRule::findOrFail($id);
            $data->delete();
            return Redirect::back()->with('success', trans('battambang/loan::write_off_rule.delete_success'));
        } catch (\Exception $e) {
            return Redirect::route('loan.write_off_rule.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    private function saveData($data)
    {
        $data->num_day = Input::get('num_day');
        $data->activated_at = Input::get('activated_at');

        $data->save();
    }

    public function getDatatable()
    {
        $item = array('id', 'num_day', 'activated_at');
        $arr = DB::table('ln_write_off_rule');

        return \Datatable::query($arr)
            ->addColumn('action', function ($model) {
                return \Action::make()
                    ->edit(route('loan.write_off_rule.edit', $model->id))
                    ->delete(route('loan.write_off_rule.destroy', $model->id))
                    ->get();
            })
            ->showColumns($item)
            ->searchColumns($item)
            ->orderColumns($item)
            ->make();
    }

}