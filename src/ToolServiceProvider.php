<?php

namespace Insenseanalytics\NovaServerMonitor;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Insenseanalytics\NovaServerMonitor\Http\Middleware\Authorize;

class ToolServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 */
	public function boot()
	{
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'nova-server-monitor');

		$this->app->booted(function () {
			$this->routes();
		});
	}

	/**
	 * Register the tool's routes.
	 */
	protected function routes()
	{
		if ($this->app->routesAreCached()) {
			return;
		}

		Route::middleware(['nova', Authorize::class])
				->prefix('nova-vendor/insenseanalytics/nova-server-monitor')
				->group(__DIR__ . '/../routes/api.php');
	}
}
