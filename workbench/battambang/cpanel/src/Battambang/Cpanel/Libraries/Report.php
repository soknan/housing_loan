<?php
/**
 * Created by JetBrains PhpStorm.
 * User: SOKNAN
 * Date: 10/9/13
 * Time: 2:28 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Battambang\Cpanel\Libraries;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;


class Report {
    protected $_fileName;
    protected $_reportName = 'microfis';
    protected $_office;
    protected $_currency;
    protected $_dateFrom;
    protected $_dateTo;

    public function setReportName($value){
        $this->_reportName = $value;
        return $this;
    }

    public function setOffice($value){
        $this->_office = $value;
        return $this;
    }

    public function setCurrency($value){
        $this->_currency = $value;
        return $this;
    }

    public function setDateFrom($value){
        $this->_dateFrom = $value;
        return $this;
    }

    public function setDateTo($value){
        $this->_dateTo = $value;
        return $this;
    }

    public function make($reportSource,$data,$store_path=null,$fileName=null){

        if($fileName==null){
            $fileName = $this->getFileName();
        }
        $fileName.='+ ['.Auth::user()->id.'] + ['.date('Y-m-d-H-i-s').']';

        $this->_fileName = $fileName;
        /**
         *	Create Directory Reports
         */
        if(!is_dir(public_path()."/reports/".Session::get('package'))){
           mkdir(public_path()."/reports/",0770);
           mkdir(public_path()."/reports/".Session::get('package')."/",0770);

        }
        if(!is_dir(public_path()."/reports/".Session::get('package').'/'.$store_path)){
            mkdir(public_path()."/reports/".Session::get('package')."/".$store_path,0770);
        }
        $path = public_path()."/reports/".Session::get('package')."/".$store_path.'/';
        /**
         *	Convert Data to Array
         */
        foreach($data as $k=>$v){
            $$k = $v;
        }
        /**
         *	Get XML Source and Write file
         */

        $xls = $fileName.".xls";
        //$zip = $fileName.".zip";
        include("/../../../../../../".Config::get('battambang/cpanel::package.'.Session::get('package').'.namespace')."/src/views/".$reportSource.".xml");
        //include($reportSource.'xml');
        File::put($path.$xls,ob_get_contents());

        ob_clean();

        // Delete source backup
        $file_name = $path.$xls;
        \App::finish(function($request, $response) use ($file_name)
        {
            unlink($file_name);
        });

        return \Response::download($path.$xls);
    }

    public function getFileName(){
        $fileName = '';
        $fileName.=$this->_reportName;

        if($this->_dateFrom!=""){
            $fileName.= " + ".$this->_dateFrom."";
            if($this->_dateTo!=""){
                $fileName.= " To ".$this->_dateTo;
            }

        }

        if($this->_office!=""){
            $fileName.= " + ".$this->_office;
        }
        if($this->_currency!=""){
            $fileName.= " + ".$this->_currency;
        }


        $this->_fileName=$fileName;
        return $fileName;
    }

    public function getLink(){
        return '<a href="'."/reports/".$this->_fileName.'.zip">Download Report</a>';
    }

}