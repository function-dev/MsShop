<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    public function attrs()
    {
        return $this->hasMany('App\attr', 'product_id');
    }
    public function quantities()
    {
        return $this->hasMany('App\quantity', 'product_id');
    }

    public function orders_product()
    {
        return $this->hasMany('App\orders_product', 'product_id');
    }

    public function collectionList()
    {
        return $this->belongsTo('App\collection_list');
    }
}
