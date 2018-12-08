# A Laravel Nova Tool for Spatie's Server Monitor Library

[![Packagist License](https://poser.pugx.org/insenseanalytics/nova-server-monitor/license.png)](http://choosealicense.com/licenses/mit/)
[![Latest Stable Version](https://poser.pugx.org/insenseanalytics/nova-server-monitor/version.png)](https://packagist.org/packages/insenseanalytics/nova-server-monitor)
[![Total Downloads](https://poser.pugx.org/insenseanalytics/nova-server-monitor/d/total.png)](https://packagist.org/packages/insenseanalytics/nova-server-monitor)

This [Nova](https://nova.laravel.com) tool allows you to monitor server health checks such as database, redis, diskspace, elasticsearch, etc. It depends on the [Spatie Server Monitor library](https://github.com/spatie/laravel-server-monitor).

<img alt="screenshot of the backup tool" src="https://s3.ap-south-1.amazonaws.com/insense-assets/nova-server-monitor2.png" />

## Quick Installation
You can install this tool into a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require insenseanalytics/nova-server-monitor
```

Next, if you do not have package discovery enabled, you need to register the provider in the `config/app.php` file:
```php
'providers' => [
    ...,
    Insenseanalytics\NovaServerMonitor\ToolServiceProvider::class,
]
```

Finally, register the tool in your `NovaServiceProvider.php` file:
```php
public function tools()
{
  \Insenseanalytics\NovaServerMonitor\NovaServerMonitor::make()
    ->onConnection('server_monitor')->hosts(['example1.com'])
    ->checks(['mysql']),
}
```

Specify your database connection using the `onConnection` method. Typically the server that monitors your app's checks would be a separate app, and we would make a separate connection in `config/database.php` that connects to the monitoring server's database. If you want to display all checks and hosts, you do not need to call the `hosts` and `checks` methods.

## Contributing
We are open to PRs as long as they're backed by tests and a small description of the feature added / problem solved.

## License

The MIT License (MIT). Please see [License File](LICENSE.txt) for more information.
