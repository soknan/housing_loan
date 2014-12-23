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

class ExchangeController extends BaseController
{

    public function index()
    {
        $item = array('Action', 'Date', 'KHR-USD', 'USD', 'KHR-THB', 'THB', 'Description');

        $data['table'] = \Datatable::table()
            ->addColumn($item) // these are the column headings to be shown
            ->setUrl(route('api.exchange')) // this is the route where data will be retrieved
            ->setOptions('aLengthMenu', array(
                array(10, 25, 50, 100, '-1'),
                array(10, 25, 50, 100, 'All')
            ))
            ->setOptions("iDisplayLength", 10)// default show entries
            ->render('battambang/cpanel::layout.templates.template');
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.exchange_index'), $data)
        );
    }

    public function create()
    {
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.exchange_create'))
        );
    }

    public function edit($id)
    {
        try {
            $arr['row'] = Exchange::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.exchange_edit'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.category.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function show($id)
    {
        try {
            $arr['row'] = Exchange::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.exchange_show'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.exchange.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function store()
    {
        $validation = $this->getValidationService('exchange');
        if ($validation->passes()) {
            $data = new Exchange();
            $this->saveData($data);
// User action
            \Event::fire('user_action.add', array('exchange'));
            return Redirect::back()
                ->with('success', trans('battambang/loan::exchange.create_success'));

        }
        return Redirect::back()->withInput()->withErrors($validation->getErrors());
    }

    public function update($id)
    {
        try {
            $validation = $this->getValidationService('exchange');
            if ($validation->passes()) {
                $data = Exchange::findOrFail($id);
                $this->saveData($data);
// User action
                \Event::fire('user_action.edit', array('exchange'));
                return Redirect::back()
                    ->with('success', trans('battambang/loan::exchange.update_success'));
            }
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        } catch (\Exception $e) {
            return Redirect::route('loan.exchange.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function destroy($id)
    {
        try {
            $data = Exchange::findOrFail($id);
            $data->delete();
            // User action
            \Event::fire('user_action.delete', array('exchange'));
            return Redirect::back()->with('success', trans('battambang/loan::exchange.delete_success'));
        } catch (\Exception $e) {
            return Redirect::route('loan.exchange.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    private function saveData($data)
    {
        $data->exchange_at = \Carbon::createFromFormat('d-m-Y',Input::get('exchange_at'))->toDateString();
        $data->khr_usd = Input::get('khr_usd');
        $data->usd = Input::get('usd');
        $data->khr_thb = Input::get('khr_thb');
        $data->thb = Input::get('thb');
        $data->des = Input::get('des');
        $data->save();
    }

    public function getDatatable()
    {
        $item = array("exchange_at",'khr_usd','usd','khr_thb','thb', 'des');
        $arr = DB::table('view_exchange');

        return \Datatable::query($arr)
            ->addColumn('action', function ($model) {
                return \Action::make()
                    ->edit(route('loan.exchange.edit', $model->id))
                    ->delete(route('loan.exchange.destroy', $model->id))
                    ->get();
            })
            ->showColumns($item)
            ->searchColumns($item)
            ->orderColumns($item)
            ->make();
    }

}