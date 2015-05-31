<?php
namespace Battambang\Loan\Libraries;

use Carbon;
use DB;

class ScheduleGenerate
{
    public function make($loanAcc, $activatedDate)
    {
        //echo $loanAcc; exit();
        $row = DB::table('view_schedule')
            ->where('ln_disburse_client_id','=',$loanAcc)->first();
        //var_dump($row); exit();
        $repayFrequency = $row->ln_lv_repay_frequency;
        //return $repayFrequency;
        // Repayment schedule
        //$repayFrequency = 3; // 2(3-Weekly, 4-Monthly)

        // Generate due date
        $schedule = array();
        switch ($repayFrequency) {
            case 3: // Weekly
                $weekly = new ScheduleWeekly();
                $schedule = $weekly->make($loanAcc, $activatedDate);
                break;
            case 4: // Monthly
                $monthly = new ScheduleMonthly();
                $schedule = $monthly->make($loanAcc, $activatedDate);
                break;
            case 130: // Daily
                $monthly = new ScheduleDaily();
                $schedule = $monthly->make($loanAcc, $activatedDate);
                break;
        }
        return $schedule;
    }

}