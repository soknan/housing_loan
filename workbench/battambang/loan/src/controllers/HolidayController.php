<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/20/13
 * Time: 4:20 PM
 */

namespace Battambang\Loan;

use Battambang\Cpanel\Facades\AutoCode;
use Input,
    Redirect,
    Request,
    View,
    DB,
    Config;
use Battambang\Cpanel\BaseController;
use UserSession;

class HolidayController extends BaseController
{

    public function index()
    {
        $item = array('Action', 'ID', 'Name', 'Holiday Date');

        $data['table'] = \Datatable::table()
            ->addColumn($item) // these are the column headings to be shown
            ->setUrl(route('api.holiday')) // this is the route where data will be retrieved
            ->setOptions('aLengthMenu', array(
                array(10, 25, 50, 100),
                array(10, 25, 50, 100)
            ))
            ->setOptions("sScrollY",300)
            ->setOptions("iDisplayLength", 10)// default show entries
            ->render('battambang/cpanel::layout.templates.template');
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.holiday_index'), $data)
        );
    }

    public function create()
    {
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.holiday_create'))
        );
    }

    public function edit($id)
    {
        try {
            $arr['row'] = Holiday::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.holiday_edit'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.category.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function show($id)
    {
        try {
            $arr['row'] = Holiday::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.holiday_show'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.holiday.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function store()
    {
        $validation = $this->getValidationService('holiday');
        if ($validation->passes()) {

            $data = new Holiday();
            $this->saveData($data);
            // User action
            \Event::fire('user_action.add', array('holiday'));
            return Redirect::back()
                ->with('success', trans('battambang/loan::holiday.create_success'));

        }
        return Redirect::back()->withInput()->withErrors($validation->getErrors());
    }

    public function update($id)
    {
        try {
            $validation = $this->getValidationService('holiday');
            if ($validation->passes()) {
                $data = Holiday::findOrFail($id);
                $this->saveData($data);
                // User action
                \Event::fire('user_action.edit', array('holiday'));
                return Redirect::back()
                    ->with('success', trans('battambang/loan::holiday.update_success'));
            }
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        } catch (\Exception $e) {
            return Redirect::route('loan.holiday.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function destroy($id)
    {
        try {
            $data = Holiday::findOrFail($id);
            $data->delete();
            // User action
            \Event::fire('user_action.delete', array('holiday'));
            return Redirect::back()->with('success', trans('battambang/loan::holiday.delete_success'));
        } catch (\Exception $e) {
            return Redirect::route('loan.holiday.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    private function saveData($data)
    {
        $data->holiday_date = date('Y-m-d', strtotime(Input::get('holiday_date')));
        $data->name = Input::get('name');
        $data->save();
    }

    public function getDatatable()
    {
        $item = array('id', 'name', 'holiday_date');
        $arr = DB::table('view_holiday');

        return \Datatable::query($arr)
            ->addColumn('action', function ($model) {
                return \Action::make()
                    ->edit(route('loan.holiday.edit', $model->id))
                    ->delete(route('loan.holiday.destroy', $model->id))
                    ->get();
            })
            ->showColumns($item)
            ->searchColumns($item)
            ->orderColumns($item)
            ->make();
    }

}