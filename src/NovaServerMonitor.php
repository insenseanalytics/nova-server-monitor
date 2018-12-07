<?php

namespace Insenseanalytics\NovaServerMonitor;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaServerMonitor extends Tool
{
	/**
	 * The hosts to monitor, leave null for all.
	 */
	public static $hosts = null;

	/**
	 * The checks to monitor, leave null for all.
	 */
	public static $checks = null;

	/**
	 * The database connection for checks.
	 *
	 * @var string|null
	 */
	public static $connection = null;

	/**
	 * Define the database connection to be used for checks.
	 *
	 * @return $this
	 */
	public function onConnection($connection)
	{
		static::$connection = $connection;

		return $this;
	}

	/**
	 * Define the hosts to monitor.
	 *
	 * @return $this
	 */
	public function hosts($hosts)
	{
		static::$hosts = $hosts;

		return $this;
	}

	/**
	 * Define the checks to monitor.
	 *
	 * @return $this
	 */
	public function checks($checks)
	{
		static::$checks = $checks;

		return $this;
	}

	/**
	 * Perform any tasks that need to happen when the tool is booted.
	 */
	public function boot()
	{
		Nova::script('nova-server-monitor', __DIR__ . '/../dist/js/tool.js');
	}

	/**
	 * Build the view that renders the navigation links for the tool.
	 *
	 * @return \Illuminate\View\View
	 */
	public function renderNavigation()
	{
		return view('nova-server-monitor::navigation');
	}
}
