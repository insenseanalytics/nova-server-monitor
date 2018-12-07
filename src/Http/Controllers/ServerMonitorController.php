<?php

namespace Insenseanalytics\NovaServerMonitor\Http\Controllers;

use Spatie\ServerMonitor\Models\Check;
use Illuminate\Support\Arr;
use Insenseanalytics\NovaServerMonitor\NovaServerMonitor;

class ServerMonitorController
{
	public function index()
	{
		$hostsToMonitor = NovaServerMonitor::$hosts;

		$checksToMonitor = NovaServerMonitor::$checks;

		$checks = Check::on(NovaServerMonitor::$connection)
				->select(['id', 'host_id', 'type', 'status', 'enabled', 'last_run_message', 'last_ran_at'])
				->when(null !== $hostsToMonitor, function ($query) use ($hostsToMonitor) {
					$query->whereHas('host', function ($query) use ($hostsToMonitor) {
						$query->whereIn('name', Arr::wrap($hostsToMonitor));
					});
				})->when(null !== $checksToMonitor, function ($query) use ($checksToMonitor) {
					$query->whereIn('type', Arr::wrap($checksToMonitor));
				})->with(['host' => function ($query) {
					$query->select(['id', 'name']);
				}])->get();

		return response()->json(compact('checks'));
	}
}
