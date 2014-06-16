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
    Input,
    Redirect,
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

    public function update($id)
    {
        try {
            $validator = CompanyValidator::make();
            if ($validator->passes()) {

                $inputs=$validator->inputs();

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
                $data->register_at = $inputs['register_at'];
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
                ->withErrors($validator->errors());
        } catch (\Exception $e) {
            return Redirect::route('cpanel.company.edit', 1)
                ->with('error', trans('battambang/cpanel::db_error.fail'));
        }
    }

} 