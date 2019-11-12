<?php

namespace Url\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $table = 'urls';

    protected $guarded = ['id'];

    protected $appends = ['count_visitor'];

    public function url_details()
    {
        return $this->hasMany(UrlDetail::class);
    }

    public function getCountVisitorAttribute()
    {
        return $this->url_details()->count();
    }
}
