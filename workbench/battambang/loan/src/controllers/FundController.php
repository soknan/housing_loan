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

class FundController extends BaseController
{

    public function index()
    {
        $item = array('Action', 'ID', 'Code', 'Name');

        $data['table'] = \Datatable::table()
            ->addColumn($item) // these are the column headings to be shown
            ->setUrl(route('api.fund')) // this is the route where data will be retrieved
            ->setOptions('aLengthMenu', array(
                array(10, 25, 50, 100),
                array(10, 25, 50, 100)
            ))
            ->setOptions("sScrollY",300)
            ->setOptions("iDisplayLength", 10)// default show entries
            ->render('battambang/cpanel::layout.templates.template');
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.fund_index'), $data)
        );
    }

    public function create()
    {
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.fund_create'))
        );
    }

    public function edit($id)
    {
        try {
            $arr['row'] = Fund::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.fund_edit'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.category.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function show($id)
    {
        try {
            $arr['row'] = Fund::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.fund_show'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.fund.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function store()
    {
        $validation = $this->getValidationService('fund');
        if ($validation->passes()) {
            $data = new Fund();
            $this->saveData($data);
// User action
            \Event::fire('user_action.add', array('fund'));
            return Redirect::back()
                ->with('success', trans('battambang/loan::fund.create_success'));

        }
        return Redirect::back()->withInput()->withErrors($validation->getErrors());
    }

    public function update($id)
    {
        try {
            $validation = $this->getValidationService('fund');
            if ($validation->passes()) {
                $data = Fund::findOrFail($id);
                $this->saveData($data);
// User action
                \Event::fire('user_action.edit', array('fund'));
                return Redirect::back()
                    ->with('success', trans('battambang/loan::fund.update_success'));
            }
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        } catch (\Exception $e) {
            return Redirect::route('loan.fund.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function destroy($id)
    {
        try {
            $data = Fund::findOrFail($id);
            $data->delete();
            // User action
            \Event::fire('user_action.delete', array('fund'));
            return Redirect::back()->with('success', trans('battambang/loan::fund.delete_success'));
        } catch (\Exception $e) {
            return Redirect::route('loan.fund.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    private function saveData($data)
    {
        $data->code = Input::get('code');
        $data->name = Input::get('name');
        $data->register_at = \Carbon::createFromFormat('d-m-Y',Input::get('register_at'))->toDateString();
        $data->address = Input::get('address');
        $data->telephone = Input::get('telephone');
        $data->email = Input::get('email');
        $data->website = Input::get('website');
        $data->save();
    }

    public function getDatatable()
    {
        $item = array('id', 'code', 'name');
        $arr = DB::table('ln_fund');

        return \Datatable::query($arr)
            ->addColumn('action', function ($model) {
                return \Action::make()
                    ->edit(route('loan.fund.edit', $model->id))
                    ->delete(route('loan.fund.destroy', $model->id))
                    ->get();
            })
            ->showColumns($item)
            ->searchColumns($item)
            ->orderColumns($item)
            ->make();
    }

}