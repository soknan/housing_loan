<?php
namespace Battambang\Loan;

use Battambang\Cpanel\Libraries\EmptyClass;
use Input,
    Redirect,
    View,
    DB,
    Config,
    Battambang\Cpanel\BaseController,
    Action;

class LookupController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $item = array('Action', 'ID', 'Code', 'Name', 'Type');
        $data['table'] = \Datatable::table()
            ->addColumn($item) // these are the column headings to be shown
            ->setUrl(route('api.ln_lookup')) // this is the route where data will be retrieved
            ->setOptions('aLengthMenu', array(
                array(10, 25, 50, 100, '-1'),
                array(10, 25, 50, 100, 'All')
            ))
            ->setOptions("iDisplayLength", 10)// default show entries
            ->render('battambang/cpanel::layout.templates.template');
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.lookup_index'), $data)
        );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $data['form_action'] = route('loan.lookup.store');
        $data['form_method'] = 'post';

        $form = new EmptyClass();

        $data['form'] = $form;
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.lookup_form'), $data)
        );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validation = $this->getValidationService('lookup');
        if ($validation->passes()) {

            $data = new Lookup();
            $this->saveData($data);

            return Redirect::back()
                ->with('success', trans('battambang/loan::lookup.create_success'));
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
        $data['show'] = Lookup::findOrFail($id);
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.lookup_show'), $data)
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
        $data['form_action'] = route('loan.lookup.update', $id);
        $data['form_method'] = 'put';

        $data['form'] = Lookup::findOrFail($id);
        return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.lookup_form'), $data)
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
        $validation = $this->getValidationService('lookup');
        if ($validation->passes()) {

            $data = Lookup::findOrFail($id);
            $this->saveData($data);

            return Redirect::back()
                ->with('success', trans('battambang/loan::lookup.update_success'));
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
        Lookup::where('id', '=', $id)->delete();
        return Redirect::back()->with('success', trans('battambang/loan::lookup.delete_success'));
	}

    private function saveData($data)
    {
        $data->code = Input::get('code');
        $data->name = Input::get('name');
        $data->type = Input::get('type');
        $data->save();
    }

    public function getDatatable()
    {
        $item = array('id', 'code', 'name', 'type');
        $data = DB::table('ln_lookup');

        return \Datatable::query($data)
            ->addColumn('action', function ($model) {
                return Action::make()
                    ->edit(route('loan.lookup.edit', $model->id))
                    ->delete(route('loan.lookup.destroy', $model->id), $model->id)
                    ->show(route('loan.lookup.show', $model->id))
                    ->get();
            })
            ->showColumns($item)
            ->searchColumns($item)
            ->orderColumns($item)
            ->make();
    }

}