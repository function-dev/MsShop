<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class collection_list extends Model
{
    protected $guarded = [];
    protected $table = 'collection_list';

    public function products()
    {
        return $this->hasMany('App\products', 'collection_id');
    }
    public function orders_product()
    {
        return $this->hasMany('App\orders_product', 'collection_id');
    }
}
