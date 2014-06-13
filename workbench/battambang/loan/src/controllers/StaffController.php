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

class StaffController extends BaseController
{

    public function index()
    {
        $item = array('Action', 'ID', 'Name(EN)', 'Name(Kh)','Gender','DOB','Position', 'Office', 'Photo');

        $data['table'] = \Datatable::table()
            ->addColumn($item) // these are the column headings to be shown
            ->setUrl(route('api.staff')) // this is the route where data will be retrieved
            ->setOptions('aLengthMenu', array(
                array('10', '25', '50', '100', '-1'),
                array('10', '25', '50', '100', 'All')
            ))
            ->setOptions("iDisplayLength", '10')// default show entries
            ->render('battambang/cpanel::layout.templates.template');
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.staff_index'), $data)
        );
    }

    public function create()
    {
        return $this->renderLayout(
            View::make(Config::get('battambang/loan::views.staff_create'))
        );
    }

    public function edit($id)
    {
        try {
            $arr['row'] = Staff::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.staff_edit'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.staff.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function show($id)
    {
        try {
            $arr['row'] = Staff::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/loan::views.staff_show'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('loan.staff.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function store()
    {
        $validation = $this->getValidationService('staff');
        if ($validation->passes()) {
            $data = new Staff();
            $photo = Input::file('attach_photo');
            $photoPath = \URL::to('/') . '/packages/battambang/cpanel/img/cp_noimage.jpg';
            if (!empty($photo)) {
                $destinationPath = public_path() . '/packages/battambang/loan/staff_photo/';
                $filename = \UserSession::read()->sub_branch . '-' .
                    $data->en_last_name.$data->en_first_name.'-'.$data->dob.'.'. $photo->getClientOriginalExtension();
                $photo->move($destinationPath, $filename);
                $photoPath = \URL::to('/') . '/packages/battambang/loan/staff_photo/' . $filename;
            }

            $this->saveData($data, $photoPath);

            return Redirect::back()
                ->with('success', trans('battambang/loan::staff.create_success'));

        }
        return Redirect::back()->withInput()->withErrors($validation->getErrors());
    }

    public function update($id)
    {
        try {
            $validation = $this->getValidationService('staff');
            if ($validation->passes()) {
                $data = Staff::findOrFail($id);
                $photo = Input::file('attach_photo');
                $photoPath = \URL::to('/') . '/packages/battambang/cpanel/img/cp_noimage.jpg';
                if (!empty($photo)) {
                    $destinationPath = public_path() . '/packages/battambang/loan/staff_photo/';
                    $filename = \UserSession::read()->sub_branch . '-' .
                        $data->en_last_name.$data->en_first_name.'-'.$data->dob.'.'. $photo->getClientOriginalExtension();
                    $photo->move($destinationPath, $filename);
                    $photoPath = \URL::to('/') . '/packages/battambang/loan/staff_photo/' . $filename;
                }

                $this->saveData($data, $photoPath, false);

                return Redirect::back()
                    ->with('success', trans('battambang/loan::staff.update_success'));
            }
            return Redirect::back()->withInput()->withErrors($validation->getErrors());
        } catch (\Exception $e) {
            return Redirect::route('loan.staff.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function destroy($id)
    {
        try {
            Staff::find($id)->delete();
            return Redirect::back()->with('success', trans('battambang/loan::staff.delete_success'));
        } catch (\Exception $e) {
            return Redirect::route('loan.staff.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    private function saveData($data, $photoPath, $store = true)
    {
        if ($store) {
            $data->id = \AutoCode::make('ln_staff', 'id', '', 4);
            $data->attach_photo = $photoPath;
        }
        $data->en_first_name = Input::get('en_first_name');
        $data->en_last_name = Input::get('en_last_name');
        $data->kh_first_name = Input::get('kh_first_name');
        $data->kh_last_name = Input::get('kh_last_name');
        $data->ln_lv_gender = Input::get('ln_lv_gender');
        $data->dob = \Carbon::createFromFormat('d-m-Y',Input::get('dob'))->toDateString() ;
        $data->ln_lv_marital_status = Input::get('ln_lv_marital_status');
        $data->ln_lv_education = Input::get('ln_lv_education');
        $data->education_des = Input::get('education_des');
        $data->ln_lv_id_type = Input::get('ln_lv_id_type');
        $data->id_num = Input::get('id_num');
        $data->expire_date = '';
        if(Input::get('expire_date')!=''){
            $data->expire_date = \Carbon::createFromFormat('d-m-Y',Input::get('expire_date'))->toDateString();
        }
        $data->ln_lv_title = Input::get('ln_lv_title');
        $data->joining_date = \Carbon::createFromFormat('d-m-Y',Input::get('joining_date'))->toDateString();
        $data->email = Input::get('email');
        $data->telephone = Input::get('telephone');
        $data->address = Input::get('address');
        $data->cp_office_id = Input::get('cp_office_id');
        $data->save();
    }

    public function getDatatable()
    {
        $item = array('id', 'en_name', 'kh_name', 'gender_name','dob','title_code', 'office_en_name');
        $arr = DB::table('view_staff')
            ->where('cp_office_id','=',\UserSession::read()->sub_branch);

        return \Datatable::query($arr)
            ->addColumn('action', function ($model) {

                return \Action::make()
                    ->edit(route('loan.staff.edit', $model->id))
                    ->delete(route('loan.staff.destroy', $model->id),'',$this->_checkStatus($model->id))
                    ->get();
            })
            ->showColumns($item)
            ->addColumn('photo', function ($model) {
                return '<img src="' . $model->attach_photo . '" width="60px" >';
            })
            ->searchColumns($item)
            ->orderColumns($item)
            ->make();
    }

    private function _checkStatus($id){
        $data = Center::where('ln_staff_id','=',$id)->count();
        if($data > 0){
            return false;
        }
        return true;
    }


}