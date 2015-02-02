<?php
namespace Battambang\Cpanel;

use Battambang\Cpanel\Libraries\EmptyClass;
use Input,
    Redirect,
    View,
    DB,
    Config,
    Action;

class LookupValueController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $item = array('Action', 'ID', 'Code', 'Name', 'Lookup ID');
        $data['table'] = \Datatable::table()
            ->addColumn($item) // these are the column headings to be shown
            ->setUrl(route('api.ln_lookup_value')) // this is the route where data will be retrieved
            ->setOptions('aLengthMenu', array(
                array(10, 25, 50, 100, '-1'),
                array(10, 25, 50, 100, 'All')
            ))
            ->setOptions("iDisplayLength", 10)// default show entries
            ->render('battambang/cpanel::layout.templates.template');
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.lookup_value_index'), $data)
        );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $data['form_action'] = route('loan.lookup_value.store');
        $data['form_method'] = 'post';

        $form = new EmptyClass();
        $data['form'] = $form;
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.lookup_value_form'), $data)
        );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validation = $this->getValidationService('lookup_value');
        if ($validation->passes()) {

            $data = new LookupValue();
            $this->saveData($data);

            return Redirect::back()
                ->with('success', trans('battambang/loan::lookup_value.create_success'));
        }
        return Redirect::back()
            ->withInput()
            ->withErrors($validation->getErrors());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $data['show'] = LookupValue::findOrFail($id);
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.lookup_value_show'), $data)
        );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $data['form_action'] = route('loan.lookup_value.update', $id);
        $data['form_method'] = 'put';

        $data['form'] = LookupValue::findOrFail($id);
        return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.lookup_value_form'), $data)
        );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validation = $this->getValidationService('lookup_value');
        if ($validation->passes()) {

            $data = LookupValue::findOrFail($id);
            $this->saveData($data);

            return Redirect::back()
                ->with('success', trans('battambang/loan::lookup_value.update_success'));
        }

        return Redirect::back()
            ->withInput()
            ->withErrors($validation->getErrors());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        LookupValue::where('id', '=', $id)->delete();
        return Redirect::back()->with('success', trans('battambang/loan::lookup_value.delete_success'));
	}

    private function saveData($data)
    {
        $data->code = Input::get('code');
        $data->name = Input::get('name');
        $data->cp_lookup_id = Input::get('cp_lookup_id');
        $data->save();
    }

    public function getDatatable()
    {
        $item = array('id', 'code', 'name', 'cp_lookup_id');
        $data = DB::table('cp_lookup_value')->orderBy('cp_lookup_id')->orderBy('name');

        return \Datatable::query($data)
            ->addColumn('action', function ($model) {

                return Action::make()
                    ->edit(route('loan.lookup_value.edit', $model->id))
                    ->delete(route('loan.lookup_value.destroy', $model->id), $model->id)
                    ->show(route('loan.lookup_value.show', $model->id))
                    ->get();
            })
            ->showColumns($item)
            ->searchColumns($item)
            ->orderColumns($item)
            ->make();
    }

}