<?php
namespace Battambang\Cpanel\Libraries;


class Security
{
    public static function make($securityFile = true, $ip = false, $expireDate = false)
    {
        $msg = '<div style="text-align: center">
                    <h1 style="background-color:#ff0000; color: #ffffff">
                        Please Contact IT Development Team ! ! !
                    </h1>
                    <p style="font-size: 20px;">
                        Mr. Yuom Theara (Team Leader), Tel: 070 550 880<br>
                        Mr. Chum Phalkun (Programmer), Tel: 092 53 16 53<br>
                        Mr. Mean Soknan (Programmer), Tel: 017 84 50 71
                    </p>
                </div>';
        // Check security file
        if ($securityFile) {
            $file = 'C:\Windows\System32\\' . \Config::get('app.key') . '.btb';
            if (!file_exists($file)) {
                echo $msg;
                exit;
            }
        }
        // Check ip address
        if ($ip) {
            if (\Request::getClientIp() != $ip) {
                echo $msg;
                exit;
            }
        }
        // Check expire date
        if ($expireDate) {
            if (date('Y-m-d') > $expireDate) {
                echo $msg;
                exit;
            }
        }
    }
}