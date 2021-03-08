<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class attr extends Model
{
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo('App\products');
    }
}
