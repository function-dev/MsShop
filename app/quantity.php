<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quantity extends Model
{
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo('App\products');
    }
}
