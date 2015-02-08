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

class DashboardController extends BaseController
{

    public function index()
    {
        $item = array('Loan Account #',
            'Disburse ID',
            'Client ID',
            'Client Name(EN)',
            'Client Name(KH)',
            'Gender',
            'ID Type',
            'ID Num',
            'Photo');
//        $data['btnAction'] = array('Add New' => route('loan.category.create'));
        $data['table'] = \Datatable::table()
            ->addColumn($item) // these are the column headings to be shown
            ->setUrl(route('api.dashboard')) // this is the route where data will be retrieved
            ->setOptions('aLengthMenu', array(
                array(10, 25, 50, 100),
                array(10, 25, 50, 100)
            ))
            ->setOptions("iDisplayLength", 10)// default show entries
            ->render('battambang/cpanel::layout.templates.template');
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.dashboard_index'), $data)
        );
    }

    public function create()
    {
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.category_create'))
        );
    }

    public function edit($id)
    {
        try {
            $arr['row'] = Category::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.category_edit'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.category.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function show($id)
    {
        try {
            //$arr['row'] = Category::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.dashboard_show'))
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.category.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function store()
    {
        $validation = $this->getValidationService('category');
        if ($validation->passes()) {
//            $data = $this->getData();
//            $data['id'] = \AutoCode::make('ln_category', 'id', '', 1);
//            Category::insert($data);

            $data = new Category();
            $this->saveData($data);

            return Redirect::back()
                ->with('success', trans('battambang/loan::category.create_success'));

        }
        return Redirect::back()->withInput()->withErrors($validation->getErrors());
    }

    public function update($id)
    {
        try {
            $validation = $this->getValidationService('category');
            if ($validation->passes()) {
//                $data = $this->getData();
//                Category::where('id', '=', $id)->update($data);

                $data = Category::findOrFail($id);
                $this->saveData($data);

                return Redirect::back()
                    ->with('success', trans('battambang/loan::category.update_success'));
            }
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        } catch (\Exception $e) {
            return Redirect::route('loan.category.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function destroy($id)
    {
        try {
//            Category::find($id)->delete();

            $data = Category::findOrFail($id);
            $data->delete();
            return Redirect::back()->with('success', trans('battambang/loan::category.delete_success'));
        } catch (\Exception $e) {
            return Redirect::route('loan.category.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    private function saveData($data)
    {
        $data->name = Input::get('name');
        $data->des = Input::get('des');
        $data->save();
    }

//    private function getData()
//    {
//        return array(
//            'name' => Input::get('name'),
//            'des' => Input::get('des'),
//        );
//    }

    public function getDatatable()
    {
        $item = array('ln_disburse_client_id',
                        'ln_disburse_id',
                        'ln_client_id',
                        'ln_client_en_name',
                        'ln_client_kh_name',
                        'gender_code',
                        'id_type_code',
                        'id_num'
                      );
        $arr = DB::table('view_dashboard');

        return \Datatable::query($arr)
            ->addColumn('action', function ($model) {
                return \HTML::link(route('loan.dashboard.show',$model->ln_disburse_client_id),$model->ln_disburse_client_id);
            })
            ->showColumns($item)
            ->searchColumns($item)
            ->orderColumns($item)
            ->addColumn('photo', function ($model) {
                return '<img src = "' . $model->attach_photo . '" width = "60px" > ';
            })
            ->make();
    }

}