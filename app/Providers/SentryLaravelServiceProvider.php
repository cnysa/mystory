<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SentryLaravelServiceProvider extends \Sentry\Laravel\ServiceProvider
{
    public static $abstract = 'sentry-laravel';
}
