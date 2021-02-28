<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class collection_list extends Model
{
    protected $table = 'collection_list';

    public function products()
    {
        return $this->hasMany('App\products', 'collection_id');
    }
}
