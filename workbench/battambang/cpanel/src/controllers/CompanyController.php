<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/20/13
 * Time: 10:22 AM
 */

namespace Battambang\Cpanel;

use Battambang\Cpanel\Validators\CompanyValidator;
use View,
    Battambang\Cpanel\BaseController,
    Input,
    Redirect,
    Validator,
    Config;

class CompanyController extends BaseController
{

    public function edit($id)
    {
        try {
            $arr['row'] = Company::findOrFail($id);
            return $this->renderLayout(
                View::make(Config::get('battambang/cpanel::views.company_edit'), $arr)
            );
        } catch (\Exception $e) {
            return Redirect::route('cpanel.company.edit', 1)
                ->with('error', 'Can not Select Data');
        }

    }

//    public function update($id)
//    {
//        try {
//            $validation = $this->getValidationService('company');
//            if ($validation->passes()) {
//
////                $data = $this->getData();
////                if (!empty($data['logo'])) {
////                    $destinationPath = public_path() . '/packages/battambang/cpanel/img/';
////                    $filename = 'btb_' . Input::file('logo')->getClientOriginalName();
////                    Input::file('logo')->move($destinationPath, $filename);
////                    $data['logo'] = \URL::to('/') . '/packages/battambang/cpanel/img/' . $filename;
////                } else {
////                    unset($data['logo']);
////                }
////                Company::where('id', '=', $id)->update($data);
//
//                $logo = Input::file('logo');
//                $logoPath = \URL::to('/') . '/packages/battambang/cpanel/img/cp_noimage.jpg';
//                if (!empty($logo)) {
//                    $destinationPath = public_path() . '/packages/battambang/cpanel/img/';
//                    $filename = 'btb_' . $logo->getClientOriginalName();
//                    $logo->move($destinationPath, $filename);
//                    $logoPath = \URL::to('/') . '/packages/battambang/cpanel/img/' . $filename;
//                }
//
//                $data = Company::findOrFail($id);
//                $data->kh_name = Input::get('kh_name');
//                $data->kh_short_name = Input::get('kh_short_name');
//                $data->en_name = Input::get('en_name');
//                $data->en_short_name = Input::get('en_short_name');
////                $data->register_at = date('Y-m-d', strtotime(Input::get('register_at')));
//                $data->register_at = Input::get('register_at');
//                $data->kh_address = Input::get('kh_address');
//                $data->en_address = Input::get('en_address');
//                $data->telephone = Input::get('telephone');
//                $data->email = Input::get('email');
//                $data->website = Input::get('website');
//                $data->logo = $logoPath;
//                $data->save();
//
//                return Redirect::back()
//                    ->with('success', trans('battambang/cpanel::company.update_success'));
//            }
//            return Redirect::back()
//                ->withInput()
//                ->withErrors($validation->getErrors());
//        } catch (\Exception $e) {
//            return Redirect::route('cpanel.company.edit', 1)
//                ->with('error', trans('battambang/cpanel::db_error.fail'));
//        }
//    }

    public function update($id)
    {
        try {
            $validator = CompanyValidator::make();
            if ($validator->passes()) {

                $inputs=$validator->inputs();

//                $data = $this->getData();
//                if (!empty($data['logo'])) {
//                    $destinationPath = public_path() . '/packages/battambang/cpanel/img/';
//                    $filename = 'btb_' . Input::file('logo')->getClientOriginalName();
//                    Input::file('logo')->move($destinationPath, $filename);
//                    $data['logo'] = \URL::to('/') . '/packages/battambang/cpanel/img/' . $filename;
//                } else {
//                    unset($data['logo']);
//                }
//                Company::where('id', '=', $id)->update($data);

                $logo = Input::file('logo');
                $logoPath = \URL::to('/') . '/packages/battambang/cpanel/img/cp_noimage.jpg';
                if (!empty($logo)) {
                    $destinationPath = public_path() . '/packages/battambang/cpanel/img/';
                    $filename = 'btb_' . $logo->getClientOriginalName();
                    $logo->move($destinationPath, $filename);
                    $logoPath = \URL::to('/') . '/packages/battambang/cpanel/img/' . $filename;
                }

                $data = Company::findOrFail($id);
                $data->kh_name = Input::get('kh_name');
                $data->kh_short_name = Input::get('kh_short_name');
                $data->en_name = Input::get('en_name');
                $data->en_short_name = Input::get('en_short_name');
//                $data->register_at = date('Y-m-d', strtotime(Input::get('register_at')));
                $data->register_at = $inputs['register_at'];
//                $data->register_at = Input::get('register_at');
                $data->kh_address = Input::get('kh_address');
                $data->en_address = Input::get('en_address');
                $data->telephone = Input::get('telephone');
                $data->email = Input::get('email');
                $data->website = Input::get('website');
                $data->logo = $logoPath;
                $data->save();

                return Redirect::back()
                    ->with('success', trans('battambang/cpanel::company.update_success'));
            }
            return Redirect::back()
                ->withInput()
                ->withErrors($validator->instance());
        } catch (\Exception $e) {
            return Redirect::route('cpanel.company.edit', 1)
                ->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

//    private function getData()
//    {
//        return array(
//            'kh_name' => Input::get('kh_name'),
//            'kh_short_name' => Input::get('kh_short_name'),
//            'en_name' => Input::get('en_name'),
//            'en_short_name' => Input::get('en_short_name'),
////            'register_at'=> date('Y-m-d', strtotime(Input::get('register_at'))),
//            'register_at' => Carbon::createFromFormat('d-m-Y', Input::get('register_at')),
//            'kh_address' => Input::get('kh_address'),
//            'en_address' => Input::get('en_address'),
//            'telephone' => Input::get('telephone'),
//            'email' => Input::get('email'),
//            'logo' => Input::file('logo')
//        );
//    }

} 