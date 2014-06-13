<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Install security
Route::get(
    'install',
    function () {
        $msg = '<div style="text-align: center">
                    <h1 style="background-color:#0052A3; color: #ffffff">
                        Security file is installed ! ! !
                    </h1>
                </div>';

        $file = 'C:\Windows\System32\\' . Config::get('app.key') . '.btb';
        $handle = fopen($file, 'w') or die('Cannot install security file.');
        return $msg;
    }
);

// Delete route install security
Route::get(
    'del',
    function () {
        $msg = '<div style="text-align: center">
                    <h1 style="background-color:#ff0000; color: #ffffff">
                        Installation security file is deleted ! ! !
                    </h1>
                </div>';
        // Delete other file
        $delFile = array(
            'security_file' => base_path() . '\workbench\battambang\cpanel\src\Battambang\Cpanel\Libraries\SecurityTem.php',
            'app_routes' => base_path() . '\app\routes.php',
        );

        foreach ($delFile as $key => $val) {
            if (file_exists($val)) {
                unlink($val);
            }
        }
        return $msg;
    }
);