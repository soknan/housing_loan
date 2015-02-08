<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/14/14
 * Time: 4:42 PM
 */

namespace Battambang\Cpanel;

use Battambang\Cpanel\Validators\UserChangePasswordValidator;
use Battambang\Cpanel\Validators\UserValidator;
use Hash;
use View;
use Redirect;
use Input;
use Config;
use DB,
    Action;

class UserController extends BaseController
{
    public function index()
    {
        $item = array(
            'Action',
            'ID',
            'First_Name',
            'Last_Name',
            'Email',
            'Username',
            'Expire_Day',
            'Activated',
            'Activated_at',
            'Group',
        );
//        $data['btnAction'] = array('Add New' => route('cpanel.user.create'));
        $data['table'] = \Datatable::table()
            ->addColumn($item) // these are the column headings to be shown
            ->setUrl(route('api.user')) // this is the route where data will be retrieved
            ->setOptions('aLengthMenu', array(
                array(10, 25, 50, 100),
                array(10, 25, 50, 100)
            ))
            ->setOptions("sScrollY",300)
            ->setOptions("iDisplayLength", 10)// default show entries
            ->render('battambang/cpanel::layout.templates.template');
        return $this->renderLayout(
            View::make(Config::get('battambang/cpanel::views.user_index'), $data)
        );
    }

    public function create()
    {
        return $this->renderLayout(
            View::make(Config::get('battambang/cpanel::views.user_create'))
        );
    }

    public function store()
    {
        $validator = UserValidator::make();
        if ($validator->passes()) {

            $inputs = $validator->getInputs();

            $data = new User();
            $this->saveData($data, $inputs);

            return Redirect::back()
                ->with('success', trans('battambang/cpanel::user.create_success'));

        }
        return Redirect::back()->withInput()->withErrors($validator->errors());
    }

    public function update($id)
    {
        try {
            $validator = UserValidator::make();
            if ($validator->passes()) {

                $inputs = $validator->getInputs();

                $data = User::findOrFail($id);
                $this->saveData($data, $inputs);

                return Redirect::back()
                    ->with('success', trans('battambang/cpanel::user.update_success'));
            }
            return Redirect::back()->withInput()->withErrors($validator->errors());
        } catch (\Exception $e) {
            return Redirect::route('cpanel.user.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function edit($code)
    {
        try {
            $arr['row'] = User::find($code);
            return $this->renderLayout(
                View::make(Config::get('battambang/cpanel::views.user_edit'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('cpanel.user.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function destroy($id)
    {
        try {
            $currentUser = \Auth::user()->id;
            if ($currentUser == $id) {
                return Redirect::back()
                    ->with('error', trans('battambang/cpanel::user.delete_denied'));
            }
//            $arr['row'] = User::find($id)->delete();

            $data = User::findOrFail($id);
            $data->delete();
            return Redirect::back()->with('success', trans('battambang/cpanel::user.delete_success'));
        } catch (\Exception $e) {
            return Redirect::route('cpanel.user.index')->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    private function saveData($data, $inputs)
    {
        $passHash = Hash::make($inputs['password']);

        $data->first_name = $inputs['first_name'];
        $data->last_name = $inputs['last_name'];
        $data->email = $inputs['email'];
        $data->username = $inputs['username'];
        $data->password = $passHash;
        $data->password_his_arr = json_encode(array($passHash));
        $data->expire_day = $inputs['expire_day'];
        $data->activated = $inputs['activated'];
        $data->activated_at = $inputs['activated_at'];
        $data->cp_group_id_arr = json_encode($inputs['group']);
//        $data->remember_token = '';
        $data->save();
    }

    public function getDatatable()
    {
        $item = array(
            'id',
            'first_name',
            'last_name',
            'email',
            'username',
            'expire_day',
            'activated',
            'activated_at'
        );

        // Check user is 'superadmin'
        if(\Auth::user()->id == 1){
            $arr = DB::table('view_user')
                ->orderBy('id');
        }else{
            $arr = DB::table('view_user')
                ->where('id', '!=', 1)
                ->orderBy('id');
        }
//        $arr = DB::table('view_user')->orderBy('id');
        return \Datatable::query($arr)
            ->addColumn(
                'action',
                function ($model) {
                    return Action::make()
                        ->edit(route('cpanel.user.edit', $model->id))
                        ->delete(route('cpanel.user.destroy', $model->id), $model->id)
//                    ->show(route('cpanel.user.show', $model->id))
                        ->get();
                }
            )
            ->showColumns($item)
            ->addColumn('cp_group_id_arr',function($model){
                foreach(json_decode($model->cp_group_id_arr) as $key=> $row){
                    $tmp[] = $this->getGroupNameBy($row);
                }
                return implode(', ',$tmp);
            })

            ->searchColumns(array('id', 'first_name', 'last_name', 'email', 'username'))
            ->orderColumns($item)
            ->make();
    }

    public function changePwd()
    {
        return $this->renderLayout(
            View::make(Config::get('battambang/cpanel::views.user_pwd'))
        );
    }

    public function postChangePwd()
    {
        try {

            $validator = UserChangePasswordValidator::make();

            if ($validator->passes()) {
                $code = \Auth::user()->id;
                $userId = User::findOrFail($code);
                $passHistory = json_decode($userId->password_his_arr, true);

                if (count($passHistory) == 5) {
                    unset($passHistory[0]);
                }
                $passHistory[] = Hash::make(Input::get('old_password'));

                $data = User::findOrFail($code);
                $data->password = Hash::make(Input::get('password'));
                $data->password_his_arr = json_encode($passHistory);
                $data->save();
                \Auth::logout();
                \UserSession::clear();
                return Redirect::to('cpanel/login')->with('logout', 'Your Password has been changed.');
            }

            return Redirect::back()->withInput()->withErrors($validator->errors());

        } catch
        (\Exception $e) {
            return Redirect::back()->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

    public function getGroupNameBy($code){
        $tmp='';
        $d = Group::where('id', '=', $code)->limit(1)->get();
        foreach ($d as $key=>$row) {
            $tmp = $row->name;
        }
        return $tmp;
    }
} 