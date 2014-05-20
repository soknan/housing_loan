<?php
namespace Battambang\Cpanel;

use Battambang\Cpanel\Facades\GetLists;
use Illuminate\Support\Facades\URL;
use View,
    Input,
    Validator,
    Config,
    UserSession,
    Response;


class HomeController extends BaseController
{

    public function getIndex()
    {
        UserSession::clear();
        return $this->renderLayout(
            View::make(Config::get('battambang/cpanel::views.home'))
        );
    }

    public function postIndex()
    {
        $rules = array(
            'user_group' => 'required',
            'branch_office' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {
            // Set user info to session
            $groupId = Input::get('user_group');
            $subBranch = Input::get('branch_office');
//            $permission = GetLists::getPermission($package);
            UserSession::write($groupId, $subBranch);

            return Response::json(
                [
                    'success' => true
                ]
            );
//            return Redirect::route('cpanel.package.home');
        }

        return Response::json(
            [
                'success' => false,
                'alert' => 'Change a few things up and try submitting again.',
                'errors' => $validator->getMessageBag()->toArray()
            ]
        );
//        return Redirect::back()
//            ->with('login_error', 'Home Error')
//            ->withInput()
//            ->withErrors($validator);
    }

//    public function postGroupChange()
//    {
//        $data['branch'] = GetLists::getBranchList(Input::get('package'));
//        $data['branch'] = '<option value="' . Input::get('package') . '">-Select One-</option>';
//        return json_encode($data);
//    }

    public function postGroupChange()
    {
        $getGroup = Group::find(Input::get('user_group'));
        $groupBranch = json_decode($getGroup->branch_arr, true);

        $dateTem = array();
        $dateTem[] = '<option value="" disabled="disabled" selected="selected">- Select One -</option>';
        $dateTem[] = GetLists::getSubBranchListAjax($groupBranch);
        $data['branch_office'] = $dateTem;
        return json_encode($data);
    }


}