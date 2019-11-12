<?php

namespace QSlack\Facades;

use Illuminate\Support\Facades\Facade;

class QSlack extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'QSlack';
    }
}
