<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

//Artisan::command('inspire', function () {
//    $this->comment(Inspiring::quote());
//})->purpose('Display an inspiring quote');

Artisan::command('makeCommand {--module=} {--c_path=} {--m_path=} {--control=}',  function ($module, $c_path = '', $m_path = '', $control) {
    $control = explode(',', $control);

    if(in_array('c', $control)) {
        $controller = isset($c_path) ? $c_path . $module : $module;
        Artisan::call("make:controller {$controller}Controller");
    }

    if(in_array('m', $control)) {
        $model = isset($m_path) ? $m_path . $module : $module;
        Artisan::call("make:model {$model}");
    }

})->describe('Running commands');
