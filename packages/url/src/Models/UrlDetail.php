<?php

namespace Url\Models;

use Illuminate\Database\Eloquent\Model;

class UrlDetail extends Model
{
    protected $table = 'url_details';

    protected $guarded = ['id'];

    protected $casts = [
        'params' => 'array'
    ];
}
