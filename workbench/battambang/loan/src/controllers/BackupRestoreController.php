<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/20/13
 * Time: 4:20 PM
 */

namespace Battambang\Loan;
use Chumper\Zipper\Zipper;
use Input,
    Redirect,
    Request,
    View,
    DB;
use Battambang\Cpanel\BaseController;

class BackupRestoreController extends BaseController
{
    public $tableNames = array(
        'ln_category'=>array('PCG','Product Category'),
        'ln_center'=>array('CET','Center',"id LIKE '[office]%'"),
        'ln_client'=>array('CLN','Client',"id LIKE '[office]%'"),
        'ln_disburse'=>array('DIS','Disbursement',"id LIKE '[office]%'"),
        'ln_disburse_client'=>array('DISC','Disburse Client',"id LIKE '[office]%'"),
        'ln_exchange'=>array('EXR','Exchange Rate'),
        'ln_fee'=>array('FEE','FEE'),
        'ln_fund'=>array('FND','Fund'),
        'ln_holiday'=>array('HLD','Holiday'),
        'ln_lookup'=>array('LOK','Lookup'),
        'ln_lookup_value'=>array('LOV','Lookup Value'),
        'ln_payment_status'=>array('PST','Payment Status'),
        'ln_penalty'=>array('PNT','Penalty'),
        'ln_penalty_closing'=>array('PTC','Penalty Closing'),
        'ln_perform'=>array('PF','Perform',"id LIKE '[office]%'"),
        'ln_product'=>array('PRO','Product'),
        'ln_product_status'=>array('PS','Product Status'),
        'ln_schedule'=>array('SC','Schedule',"id LIKE '[office]%'"),
        'ln_schedule_dt'=>array('SCD','Schedule Detail',"id LIKE '[office]%'"),
        'ln_staff'=>array('ST','Staff',"cp_office_id LIKE '[office]%'"),
    );
    public $databaseType = array(
        'loan'=>array(
            array(
                'ln_lookup',
                'ln_lookup_value',
                'ln_payment_status',
                'ln_penalty',
                'ln_penalty_closing',
                'ln_product_status',
                'ln_category',
                'ln_exchange',
                'ln_fee',
                'ln_fund',
                'ln_holiday',
                'ln_staff',
                'ln_product',
            ),
            array(
                'ln_center',
                'ln_client',
                'ln_disburse',
                'ln_disburse_client',
                'ln_perform',
                'ln_schedule',
                'ln_schedule_dt',
            ),

        ),
        'cpanel'=>array(
            'cp_company',
            'cp_currency',
            'cp_group',
            'cp_location',
            'cp_location',
            'cp_lookup',
            'cp_lookup_value',
            'cp_office',
            'cp_user',
            'cp_workday',
        ),
    );

    public function indexBackup(){
        $data['table']= $this->getTableList(\UserSession::read()->package);
        return $this->renderLayout(
            View::make('battambang/loan::backup_restore.backup',$data)
        );
    }
    public function indexRestore(){
        $data['table']= $this->getTableList(\UserSession::read()->package);
        return $this->renderLayout(
            View::make('battambang/loan::backup_restore.restore',$data)
        );
    }

    public function postBackup(){
        $value = $this->getData();
        return $this->backup($value);
    }

    public function postRestore(){
        $value = $this->getData();
        return $this->restore($value);
    }

    public function backup($values)
    {
        $return = "";
        $table_type = array();

        foreach ($values["table"] as $table) {
            $table_type[] = $this->getTableCode($table);
            $return .= $this->getBackupScript($values, $table);
        }

        $return = "-- Microfis SQL Backup/Restore \n-- Version 2.0 \n-- Generation Time: " . date("Y-M-d h:i:s A") . "\n-- Database: " . ucfirst($values["package"]). "\n-- Branch Office: " . implode(", ", $values["branch"]) . "\n-- Tables Type: " . implode(", ", $table_type) . " \n-- Developed by: Battambang IT Team. \n \n-- --------------------------------------------------------;" . $return;
        //$this->load->helper("file");

        $file_name = ucfirst($values["package"]);
        $file_name .= " + " . date("Y-m-d His") . " + " . implode(",", $values["branch"]) . " + " . implode(",", $table_type);

        \File::put($file_name . '.sql', $return);

        $zipFile = new Zipper();
        $zipFile->zip(public_path().'/backup/'.$file_name.'.zip')->add($file_name . '.sql');
        $zipFile->close();

        unlink($file_name.'.sql');
        //unlink($file_name.'.zip');
        return \Response::download(public_path().'/backup/'.$file_name . '.zip');

    }

    public function restore($values,$err = "Invalid File Name.")
    {
        $table_type = array();
        foreach ($values["table"] as $table) {
            $table_type[] = $this->getTableCode($table);
        }
        $file_name = ucfirst($values["package"]);
        $file_name .= " + " . date("Y-m-d His") . " + " . implode(",", $values["branch"]) . " + " . implode(",", $table_type);

        $file_to_restore = $_FILES['file_to_restore'];

        //var_dump($file_to_restore); exit;
        $zip_name = $file_to_restore["name"];
        $tmp_name = $file_to_restore["tmp_name"];

        $file_name_arr = explode("+", $file_name . ".zip");
        $zip_name_arr = explode("+", $zip_name);
        //echo count($file_name_arr);
        for ($i = 0; $i < count($file_name_arr); $i++) {
            if ($i == 1) {
                continue;
            }
            if (trim($file_name_arr[$i]) != trim($zip_name_arr[$i])) {
                return Redirect::back()->with('error',$err);
            }
        }

        // unzip file upload
        $zip = new \ZipArchive();

        $file_unzip = $tmp_name;
        //echo $tmp_name;
        // open archive
        if ($zip->open($file_unzip) !== TRUE) {
            die ('Could not open archive');
        }
        // extract contents to destination directory
        $zip->extractTo('.');
        // close archive
        $zip->close();

        $file_name = str_replace(".zip", "", $zip_name);

        if (file_exists($file_name . ".sql")) {
            //Restore
            $file_content = file($file_name . ".sql");
            $query = "";
            //var_dump($file_content); exit;
            foreach ($file_content as $sql_line) {
                //if(trim($sql_line) != "" && strpos($sql_line, "--") === false){
                $query.= $sql_line;
                if (substr(rtrim($query), -1) == ';') {
                    DB::unprepared($query);
                    $query = "";
                }
                //}
            }

        } else {
            return Redirect::back()->with('error',$err);
        }

        foreach (glob("*.sql") as $filename_sql) {
            unlink($filename_sql);
        }

        //if ($err != "") {
        //    return Redirect::back()->with('error',$err);
        //}

        return Redirect::back()->with('success','Restored OK !');
    }

    public function getBackupScript($value, $table)
    {
        $return = "\n\n--\n-- Backup Table: " . $table . "\n--;";
        // create table
        $query = DB::select("SHOW CREATE TABLE " . $table);
        $result = $query;
        $result = $result[0];
        $result = $result->{'Create Table'};
        //var_dump($result); exit();
        $create_tables = "CREATE TABLE";
        if (!(substr($result, 0, strlen($create_tables)) == $create_tables)) {
            $result = "\n\n" . preg_replace("/CREATE/", "CREATE OR REPLACE ", $result) . ";";
            $return .= $result;
            return $return;
        }
        $result = "\n\n" . preg_replace("/CREATE TABLE/", "CREATE TABLE IF NOT EXISTS", $result) . ";";
        $return .= $result;

        // delete data
        foreach ($value["branch"] as $office) {
            $where = "";
            if (isset($this->tableNames[$table][2])) {
                $where = " WHERE " . str_replace('[office]', $office, $this->tableNames[$table][2]);
            }
            $delete = "\n\n DELETE FROM " . $table . " " . $where . ";";
            $return .= $delete;
            // insert data

            $query = DB::select("SELECT * FROM " . $table . $where);
            if (count($query) > 0) {
                //var_dump($query); exit();
                foreach ($query as $result) {
                    $result = (array)$result;
                    $return .= "\n INSERT INTO " . $table . " VALUES('" . implode("','", $result) . "');";
                }
            }

            if (!isset($this->tableNames[$table][2])) {
                break;
            }
        }
        return $return;
    }

    public function getData(){
        return array(
            'branch'=>Input::get('branch'),
            'package'=>Input::get('package'),
            'table'=>Input::get('table'),
        );
    }

    public function getTableName($table)
    {
        if (isset($this->tableNames[$table])) {
            return $this->tableNames[$table][0] . " - " . $this->tableNames[$table][1];
        }
        return "OOO - " . $table;
    }

    public function getTableCode($table)
    {
        if (isset($this->tableNames[$table])) {
            return $this->tableNames[$table][0];
        }
        return "OOO";
    }
    public function getTableList($db_type = "", $echo = TRUE){
        $arr = array();
        if ($db_type == "") {
            return $arr;
        }
        if (isset($this->databaseType[$db_type])) {
            $this->databaseType[$db_type];
            $tmp = array();
            $tmp = $this->databaseType[$db_type];
            if (in_array(\Auth::user()->cp_group_id, array('1',2))) {
                $tmp = $this->databaseType[$db_type];
            }
            $table = array();
            foreach ($tmp as $row) {
                foreach($row as $val){
                    $table[$val]= $this->getTableName($val);
                }

            }
        }
        return $table;
        //return $arr;
    }
}