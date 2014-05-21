<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/28/14
 * Time: 4:32 PM
 */

namespace Battambang\Cpanel\Libraries;

use Battambang\Cpanel\Group;
use Session;

class UserSession
{

    public function clear()
    {
        Session::forget('group');
        Session::forget('group_name');
        Session::forget('package');
        Session::forget('branch_arr');
        Session::forget('branch');
        Session::forget('sub_branch');
        Session::forget('permission');
    }

    public function write($groupId, $subBranch)
    {
        $group = Group::find($groupId);
        Session::put('group', $group->id);
        Session::put('group_name', $group->name);
        Session::put('package', $group->package);
        Session::put('branch_arr', $group->branch_arr);
        Session::put('branch', substr($subBranch, 0, 2));
        Session::put('sub_branch', $subBranch);
        Session::put('permission', json_decode($group->permission_arr, true));
    }


    /**
     * @return \stdClass
     */
    public function read()
    {
        $arr = new \stdClass();
        $arr->group = Session::get('group');
        $arr->group_name = Session::get('group_name');
        $arr->package = Session::get('package');
        $arr->branch_arr = Session::get('branch_arr');
        $arr->branch = Session::get('branch');
        $arr->sub_branch = Session::get('sub_branch');
        $arr->permission = Session::get('permission');
        return $arr;
    }
} 