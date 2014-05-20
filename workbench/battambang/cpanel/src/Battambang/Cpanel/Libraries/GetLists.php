<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/17/14
 * Time: 2:33 PM
 */

namespace Battambang\Cpanel\Libraries;

use Battambang\Cpanel\Group;
use Battambang\Cpanel\Lookup;
use Battambang\Cpanel\Office;
use DB;
use Auth;
use Config;
use Battambang\Cpanel\User;

class GetLists
{

    public function getUserPermission()
    {
        $arr = array();
        $data = DB::select(
            'SELECT * FROM cp_user INNER JOIN cp_group on cp_user.cp_group_id=cp_group.id where cp_user.id ="' . Auth::user(
            )->id . '"'
        );

        if ($data) {
            foreach ($data as $key => $row) {
                $arr['package_arr'] = $row->package_arr;
                $arr['branch_arr'] = $row->branch_arr;
                $arr['permission_arr'] = $row->permission_arr;
            }
            return $arr;
        }
        return $arr;
    }

    public function getPackageList()
    {
        $arr = array();
        $data = $this->getUserPermission();
        if ($data) {
            foreach (json_decode($data['package_arr']) as $value) {
                $arr[$value] = \Config::get('battambang/cpanel::package.' . $value . '.name');
            }
            return $arr;
        }
        return $arr;
    }

    public function getBranchList($package = null, $list = true)
    {
        $arr = '<option value="" disabled="disabled" selected="selected">- Select One -</option>';
        $sub = array();
        $data = $this->getUserPermission();
        foreach (json_decode($data['branch_arr']) as $key => $value) {
            if ($key == $package) {
                $sub [] = $value;
                foreach ($value as $k => $v) {
                    $arr .= '<option value="' . $k . '">' . $this->getBranchOfficeBy($k) . '</option>';
                }
            }
        }
        if ($list == false) {
            return $sub;
        }
        return $arr;
    }

    public function getSubBranchListAjax($default = array(), $optGroup = true)
    {
        // Get office
        $office = Office::get();
        $officeArr = array();
        foreach ($office as $list) {
            $officeArr[$list->id] = array('kh_name' => $list->kh_name, 'en_name' => $list->en_name);
        }

        if (count($default) == 0) {
            $getSubBranch = array_where(
                $officeArr,
                function ($key, $value) {
                    return (strlen($key) == 4);
                }
            );
            foreach ($getSubBranch as $key => $value) {
                $default[] = $key;
            }
        }

        // Sort array
        asort($default);
        $arr = '';

        if ($optGroup) {
            $optGroupTem = '';
            $chk = 0;
            foreach ($default as $value) {
                $subValue = substr($value, 0, 2);
                if ($optGroupTem != $subValue) {
                    if ($chk > 0) {
                        $arr .= '</optgroup>';
                    }
                    $arr .= '<optgroup label="' . $subValue . ' : ' . array_get(
                            $officeArr,
                            $subValue . '.en_name'
                        ) . '">';
                    $optGroupTem = $subValue;
                }
                $chk += 1;
                $arr .= '<option value="' . $value . '">' .
                    $value . ' : ' . array_get($officeArr, $value . '.en_name') .
                    '</option>';

                if (count($default) == $chk) {
                    $arr .= '</optgroup>';
                }
            }
        } else {
            foreach ($default as $value) {
                $arr .= '<option value="' . $value . '">' . $value . ' : ' .
                    array_get($officeArr, $value . '.en_name') .
                    '</option>';
            }
        }
        return $arr;
    }

    public function getSubBranchList($whereArray = array())
    {
        $getOffice = Office::get();
        $getOfficeToArray = $getOffice->toArray();

        $data = array();

        $getBranch = array_where(
            $getOfficeToArray,
            function ($key, $value) {
                return (strlen($value['id']) == 2);
            }
        );
        foreach ($getBranch as $getBranchKey => $getBranchValue) {
            $getSubBranch = array_where(
                $getOfficeToArray,
                function ($key, $value) use ($getBranchValue) {
                    return (strlen($value['id']) == 4 and starts_with($value['id'], $getBranchValue));
                }
            );
            $getSubBranchTem = array();
            foreach ($getSubBranch as $getSubBranchKey => $getSubBranchKeyValue) {
                $getSubBranchTem[$getSubBranchKeyValue['id']] = $getSubBranchKeyValue['id'] . ' : ' . $getSubBranchKeyValue['en_name'];
            }

            // Where
            if (count($whereArray) > 0) {
                $where = array_where(
                    $getSubBranchTem,
                    function ($key, $value) use ($whereArray) {
                        foreach ($whereArray as $whereArrayKey => $whereArrayValue) {
                            if ($whereArrayKey == 0) {
                                $compare = ($key == $whereArrayValue);
                            } else {
                                $compare = ($compare or $key == $whereArrayValue);
                            }
                        }
                        return ($compare);
                    }
                );

                if (count($where) > 0) {
                    $data[$getBranchValue['id'] . ' : ' . $getBranchValue['en_name']] = $where;
                }
            } else {
                $data[$getBranchValue['id'] . ' : ' . $getBranchValue['en_name']] = $getSubBranchTem;
            }
        }
        return $data;
    }

    public function getSubBranchListNoAjax()
    {
        $arr = array();
        $data = $this->getUserPermission();
        foreach (json_decode($data['branch_arr']) as $key => $value) {
            //if ($key == $package) {
            foreach ($value as $k => $row) {
                foreach ($row as $v) {
                    $arr[$k . ' : ' . $this->getBranchOfficeBy($k)][$v] = $v . ' : ' . $this->getBranchOfficeBy($v);
                }
            }
            //}
        }
        return $arr;
    }

    public function getBranchListNoAjax($package = '')
    {
        $arr = array();
        $data = $this->getUserPermission();
        foreach (json_decode($data['branch_arr']) as $key => $value) {
            if ($key == $package) {
                foreach ($value as $n => $row) {
                    $arr[$n] = $n . ' - ' . $this->getBranchOfficeBy($n);
                }
            }
        }
        return $arr;
    }


    public function getPermission($package, $branch = null, $subBranch = null)
    {
        $data = $this->getUserPermission();
        $arr = array();
        foreach (json_decode($data['permission_arr']) as $key => $value) {
            if ($key == $package) {
                foreach ($value as $k => $v) {
                    foreach ($v as $row) {
                        $arr[$k][] = $row;
                    }
                }
            }
        }
        return $arr;
    }

    public function getBranchOfficeBy($code)
    {
        $data = Office::where('id', '=', $code)->first();
        return $data->en_name;
    }

    public function getMainSubBranch(&$branch_list, &$branch_rel_sub_list, &$branch_rel_list)
    {
        $branch_list = array();
        $branch_rel_sub_list = array();
        $branch_rel_list = array();
        $data = Office::all();
        foreach ($data as $row) {
            $branch_list[$row->id] = $row;
            $branch_rel_sub_list[$row->id] = $row->cp_office_id;
            $branch_rel_list[$row->cp_office_id][] = $row->id;
        }
        return $this;
    }

    public function getAllBranchList()
    {
        $data = Office::where('cp_office_id', '=', '')->get();
        $arr[''] = '--Select One--';
        foreach ($data as $row) {
            $arr[$row->id] = $row->id . ' : ' . $row->en_name;
        }
        return $arr;
    }

    private function  _getBranchSpace($main = '', $level = 0)
    {
        $records = array();
        $sql = "SELECT * FROM cp_office ";
        $sql .= "WHERE cp_office_id = '" . $main . "'";
        $sql .= " ORDER BY id";
        $space = "";
        for ($i = 0; $i < $level; $i++) {
            $space .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        }

        $query = DB::select($sql);
        foreach ($query as $row) {
            $row->id = $space . $row->id;
            $row->en_name = $space . $row->en_name;
            $records[] = $row;
            $records = array_merge($records, $this->_getBranchSpace($row->id, $level + 1));
        }
        return $records;
    }

    public function getAllPackageList()
    {
        $data = Config::get('battambang/cpanel::package');
        $arr = array();
        if ($data) {
            foreach ($data as $key => $row) {
                $arr[$key] = $row['name'];
            }
            return $arr;
        }
        return $arr;
    }

    public function getAllMenuList($where)
    {
        $getPackageMenu = Config::get('battambang/cpanel::package.' . $where . '.menu');
        $arr = array();
        foreach ($getPackageMenu as $value) {
            if (starts_with($value, 'rpt')) {
                $arr[ucwords(str_replace('_', ' ', $value))] = array($value . '.show' => 'Show');
            } else {
                $arr[ucwords(str_replace('_', ' ', $value))] = array(
                    $value . '.show' => 'Show',
                    $value . '.add' => 'Add',
                    $value . '.edit' => 'Edit',
                    $value . '.delete' => 'Delete',
                );
            }
        }
        return $arr;
    }

    public function getAllMenuListAjax($where)
    {
        $getPackageMenu = Config::get('battambang/cpanel::package.' . $where . '.menu');
        $arr = '';
        foreach ($getPackageMenu as $value) {
            $arr .= '<optgroup label="' . ucwords(str_replace('_', ' ', $value)) . '">';
            if (starts_with($value, 'rpt')) {
                $arr .= '<option value="' . $value . '.show">Show</option>';
            } else {
                $arr .= '<option value="' . $value . '.show">Show</option>';
                $arr .= '<option value="' . $value . '.add">Add</option>';
                $arr .= '<option value="' . $value . '.edit">Edit</option>';
                $arr .= '<option value="' . $value . '.delete">Delete</option>';
            }
            $arr .= '</optgroup>';
        }
        return $arr;
    }

    public function getAllPermissionList()
    {
        $data = array(
            "show" => "Show a record from database",
            "add" => "Add new record to the database",
            "edit" => "Edit any record of the database",
            "delete" => "Delete  data from current database",
            /*"upload" => "Upload  file to be reference",
            "backup" => "Backup the record of database",
            "restore" => "Restore the record of database",
            "audit" => "Audit trail how user use database",
            "decode" => "Generate Code when delete",
            "report" => "View Report of database"*/
        );
        return $data;
    }


    public function getGroupList()
    {
        $data = Group::all();
        $arr = array();
        if ($data) {
            foreach ($data as $row) {
                $arr[$row->id] = $row->name;
            }
            return $arr;
        }
        return $arr;
    }

    public function getActivatedList()
    {
        $arr = array(
            '0' => 'No',
            '1' => 'Yes'
        );
        return $arr;

    }

    public function hasPermissions($module, $str)
    {
        try {
            if (in_array($str, array('home'))) {
                return true;
            }
            $permission = \Session::get('permission');
            $arr = '';
            foreach ($permission[$module] as $a) {
                $arr .= $a . ',';
            }
            $found = strpos(strtolower($arr), strtolower($str));
            //echo $found; exit();
            if ($found !== false) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }


    }

    public function lookup()
    {
        $list = array();
        $data = Lookup::orderBy('name')->lists('name', 'id');
//        foreach ($data as $value) {
//            $list[$value->id] = $value->name;
//        }
        return $data;
    }

    public function userGroup()
    {
        $group = Group::whereIn('id', json_decode(Auth::user()->cp_group_id_arr, true))
            ->get();
        $data = array();
        foreach ($group as $list) {
            $data[$list->id] = $list->name . ' [ ' . ucfirst($list->package) . ' ]';
        }

        return $data;
    }
}