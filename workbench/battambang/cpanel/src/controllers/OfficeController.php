<?php
namespace Battambang\Cpanel;

use Battambang\Cpanel\Validators\OfficeValidator;
use Input,
    Redirect,
    View,
    DB,
    Config,
    Action;

class OfficeController extends BaseController
{

    public function index()
    {
        $item = array('Action', 'ID', 'Kh Name', 'Kh Short Name', 'En Name', 'En Short Name', 'Register At', 'Main Office', 'Telephone');
//        $data['btnAction'] = array('Add New' => route('cpanel.office.create'));
        $data['table'] = \Datatable::table()
            ->addColumn($item) // these are the column headings to be shown
            ->setUrl(route('api.office')) // this is the route where data will be retrieved
            ->setOptions('aLengthMenu', array(
                array(10, 25, 50, 100, '-1'),
                array(10, 25, 50, 100, 'All')
            ))
            ->setOptions("iDisplayLength", 10)// default show entries
            ->render('battambang/cpanel::layout.templates.template');
        return $this->renderLayout(
            View::make(Config::get('battambang/cpanel::views.office_index'), $data)
        );
    }

    public function create()
    {
        return $this->renderLayout(
            View::make(Config::get('battambang/cpanel::views.office_create'))
        );
    }

    public function edit($id)
    {
        try {
            $arr['row'] = Office::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/cpanel::views.office_edit'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('cpanel.office.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function show($id)
    {
        try {
            $arr['row'] = Office::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/cpanel::views.office_show'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('cpanel.office.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function store()
    {
        $validator = OfficeValidator::make();

        if ($validator->passes()) {

            $data = new Office();
            $this->saveData($data);

            return Redirect::back()
                ->with('success', trans('battambang/cpanel::office.create_success'));
        }
        return Redirect::back()->withInput()->withErrors($validator->errors());
    }

    public function update($id)
    {
        try {
            $validator = OfficeValidator::make();
            if ($validator->passes()) {

                $data = Office::findOrFail($id);
                $this->saveData($data, false);

                return Redirect::back()
                    ->with('success', trans('battambang/cpanel::office.update_success'));
            }
            return Redirect::back()->withInput()->withErrors($validator->errors());
        } catch (\Exception $e) {
            return Redirect::route('cpanel.office.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function destroy($id)
    {
        try {

            $data = Office::findOrFail($id);
            $data->delete();

            return Redirect::back()->with('success', trans('battambang/cpanel::office.delete_success'));
        } catch (\Exception $e) {
            return Redirect::route('cpanel.office.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    private function saveData($data, $store = true)
    {
        if ($store) {
            $data->id = \AutoCode::make('cp_office', 'id', Input::get('cp_office_id'), 2);
        }
        $data->en_name = Input::get('en_name');
        $data->en_short_name = Input::get('en_short_name');
        $data->kh_name = Input::get('kh_name');
        $data->kh_short_name = Input::get('kh_short_name');
        $data->cp_office_id = Input::get('cp_office_id');
        $data->register_at = date('Y-m-d', strtotime(Input::get('register_at')));
        $data->kh_address = Input::get('kh_address');
        $data->en_address = Input::get('en_address');
        $data->telephone = Input::get('telephone');
        $data->email = Input::get('email');
        $data->save();
    }

    public function getDatatable()
    {
        $item = array('id', 'kh_name', 'kh_short_name', 'en_name', 'en_short_name', 'register_at', 'cp_office_id', 'telephone');
        $arr = DB::table('view_office')->orderBy('id');

        return \Datatable::query($arr)
            ->addColumn(
                'action',
                function ($model) {
                    return Action::make()
                        ->edit(route('cpanel.office.edit', $model->id))
                        ->delete(route('cpanel.office.destroy', $model->id), $model->id)
                        ->show(route('cpanel.office.show', $model->id))
                        ->get();
                }
            )
            ->showColumns($item)
            ->searchColumns($item)
            ->orderColumns($item)
            ->make();
    }

}