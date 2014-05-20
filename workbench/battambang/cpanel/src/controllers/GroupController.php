<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/22/14
 * Time: 1:53 PM
 */

namespace Battambang\Cpanel;

use Battambang\Cpanel\Validators\GroupValidator;
use View;
use Config;
use DB;
use Input;
use Redirect;
use Action;

class GroupController extends BaseController
{
    protected $_arr = array();
    protected $_arr_package = array();
    protected $_arr_per = array();

    public function index()
    {
        $item = array('Action', 'ID', 'Name', 'Package', 'Branch', 'Permission');
//        $data['btnAction'] = array('Add New' => route('cpanel.group.create'));
        $data['table'] = \Datatable::table()
            ->addColumn($item) // these are the column headings to be shown
            ->setUrl(route('api.group')) // this is the route where data will be retrieved
            ->setOptions(
                'aLengthMenu',
                array(
                    array('10', '25', '50', '100', '-1'),
                    array('10', '25', '50', '100', 'All')
                )
            )
            ->setOptions("iDisplayLength", '10')// default show entries
            ->render('battambang/cpanel::layout.templates.template');
        return $this->renderLayout(
            View::make(Config::get('battambang/cpanel::views.group_index'), $data)
        );

    }

    public function create()
    {
        return $this->renderLayout(
            View::make(Config::get('battambang/cpanel::views.group_create'))
        );
    }

    public function store()
    {

        $validator = GroupValidator::make();
        if ($validator->fails()) {
            return \Response::json(
                array(
                    'success' => false,
                    'alert' => 'Change a few things up and try submitting again.',
                    'errors' => $validator->errors()->toArray()
                )
            );
        }

        $data = new Group();
        $this->saveData($data);

        return \Response::json(
            array(
                'success' => true,
                'alert' => 'Your data save successfully.',
            )
        );

    }

    public function edit($code)
    {
        $data['record'] = Group::find($code);
        return $this->renderLayout(
            View::make(Config::get('battambang/cpanel::views.group_edit'), $data)
        );
    }

    public function update($code)
    {
        $validator = GroupValidator::make();
        if ($validator->fails()) {
            return \Response::json(
                array(
                    'success' => false,
                    'alert' => 'Change a few things up and try submitting again.',
                    'errors' => $validator->errors()->toArray()
                )
            );
        }

        $data = Group::find($code);
        $this->saveData($data);

        return \Response::json(
            array(
                'success' => true,
                'alert' => 'Your data save successfully.',
            )
        );
    }

    public function destroy($code)
    {
        try {
            $data = Group::findOrFail($code);
            $data->delete();

            return Redirect::back()
                ->with('success', trans('battambang/cpanel::group.delete_success'));
        } catch (\Exception $e) {
            return Redirect::route('cpanel.group.index')
                ->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    private function saveData($data)
    {
        $data->name = Input::get('group_name');
        $data->package = Input::get('package');
        $data->branch_arr = json_encode(Input::get('branch_office'));
        $data->permission_arr = json_encode(Input::get('permission'));
        $data->save();
    }

    public function getDatatable()
    {
        $item = array('id', 'name', 'package', 'branch_arr', 'permission_arr');
        $arr = \DB::table('cp_group');
        return \Datatable::query($arr)
            ->addColumn(
                'action',
                function ($model) {
                    return Action::make()
                        ->edit(route('cpanel.group.edit', $model->id))
                        ->delete(route('cpanel.group.destroy', $model->id), $model->id)
//                    ->show(route('cpanel.group.show', $model->id))
                        ->get();
                }
            )
            ->showColumns($item)
            ->searchColumns($item)
            ->orderColumns($item)
            ->make();
    }

    public function postPackageChange()
    {
        $data['permission'] = \GetLists::getAllMenuListAjax(Input::get('package'));
        return json_encode($data);
    }
} 