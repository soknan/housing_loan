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

class CategoryController extends BaseController
{

    public function index()
    {
        $item = array('Action', 'ID', 'Name', 'Desc');
//        $data['btnAction'] = array('Add New' => route('loan.category.create'));
        $data['table'] = \Datatable::table()
            ->addColumn($item) // these are the column headings to be shown
            ->setUrl(route('api.category')) // this is the route where data will be retrieved
            ->setOptions('aLengthMenu', array(
                array('10', '25', '50', '100', '-1'),
                array('10', '25', '50', '100', 'All')
            ))
            ->setOptions("iDisplayLength", '10')// default show entries
            ->render('battambang/cpanel::layout.templates.template');
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.category_index'), $data)
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
            $arr['row'] = Category::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.category_show'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.category.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function store()
    {
        $validation = $this->getValidationService('category');
        if ($validation->passes()) {

            $data = new Category();
            $this->saveData($data);

            // User action
            \Event::fire('user_action.add', array('category'));

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

                // User action
                \Event::fire('user_action.edit', array('category'));

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

            // User action
            \Event::fire('user_action.delete', array('category'));

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
        $item = array('id', 'name', 'des');
        $arr = DB::table('ln_category');

        return \Datatable::query($arr)
            ->addColumn('action', function ($model) {
                return \Action::make()
                    ->edit(route('loan.category.edit', $model->id))
                    ->delete(route('loan.category.delete', $model->id),'',$this->_checkStatus($model->id))
                    ->get();
            })
            ->showColumns($item)
            ->searchColumns($item)
            ->orderColumns($item)
            ->make();
    }

    private function _checkStatus($id){
        $data = Product::where('ln_category_id','=',$id)->count();
        if($data > 0){
            return false;
        }
        return true;
    }

}