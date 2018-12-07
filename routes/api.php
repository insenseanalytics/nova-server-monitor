<?php

use Illuminate\Support\Facades\Route;
use Insenseanalytics\NovaServerMonitor\Http\Controllers\ServerMonitorController;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::get('/index', ServerMonitorController::class . '@index');

/*
 * TODO
 * 1. Specific hosts and checks
 * 2. Icons for status + tool
 */
