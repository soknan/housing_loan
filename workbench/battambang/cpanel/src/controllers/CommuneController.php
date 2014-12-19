<?php
namespace Battambang\Cpanel;

use Battambang\Cpanel\Validators\communeValidator;
use Input,
    Redirect,
    View,
    DB,
    Config,
    Action;
use Battambang\Cpanel\Location;

class CommuneController extends BaseController
{

    public function index()
    {
        $item = array('Action', 'ID', 'Kh Name','En Name','Parent ID');
//        $data['btnAction'] = array('Add New' => route('cpanel.commune.create'));
        $data['table'] = \Datatable::table()
            ->addColumn($item) // these are the column headings to be shown
            ->setUrl(route('api.commune')) // this is the route where data will be retrieved
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
            View::make(Config::get('battambang/cpanel::views.commune_index'), $data)
        );
    }

    public function create()
    {
        return $this->renderLayout(
            View::make(Config::get('battambang/cpanel::views.commune_create'))
        );
    }

    public function edit($id)
    {
        try {
            $arr['row'] = DB::table('cp_location')->where('id','=',$id)->first();
            return $this->renderLayout(
                View::make(Config::get('battambang/cpanel::views.commune_edit'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('cpanel.commune.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function show($id)
    {
        try {
            $arr['row'] = Location::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/cpanel::views.commune_show'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('cpanel.commune.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function store()
    {
        $validator = CommuneValidator::make();

        if ($validator->passes()) {

            $data = new Location();
            $this->saveData($data);

            return Redirect::back()
                ->with('success', trans('battambang/cpanel::commune.create_success'));
        }
        return Redirect::back()->withInput()->withErrors($validator->errors());
    }

    public function update($id)
    {
        try {
            $validator = CommuneValidator::make();
            if ($validator->passes()) {

                $data = Location::findOrFail($id);
                $this->saveData($data, false);

                return Redirect::back()
                    ->with('success', trans('battambang/cpanel::commune.update_success'));
            }
            return Redirect::back()->withInput()->withErrors($validator->errors());
        } catch (\Exception $e) {
            return Redirect::route('cpanel.commune.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function destroy($id)
    {
        try {

            $data = Location::findOrFail($id);
            $data->delete();

            return Redirect::back()->with('success', trans('battambang/cpanel::commune.delete_success'));
        } catch (\Exception $e) {
            return Redirect::route('cpanel.commune.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    private function saveData($data, $store = true)
    {
        if ($store) {
            $data->id = Input::get('id');
        }
        $data->en_name = Input::get('en_name');
        $data->kh_name = Input::get('kh_name');
        $data->cp_location_id = Input::get('cp_location_id');
        $data->save();
    }

    public function getDatatable()
    {
        $item = array('id', 'kh_name','en_name','cp_location_id');
        $arr = DB::table('cp_location')->whereRaw('LENGTH(cp_location_id) = 4')->orderBy('id');

        return \Datatable::query($arr)
            ->addColumn(
                'action',
                function ($model) {
                    //return '';
                    return Action::make()
                        ->edit(route('cpanel.commune.edit', $model->id))
                        ->delete(route('cpanel.commune.destroy', $model->id), $model->id)
                        /*->show(route('cpanel.commune.show', $model->id))*/
                        ->get();
                }
            )
            ->showColumns($item)
            ->searchColumns($item)
            ->orderColumns($item)
            ->make();
    }

}