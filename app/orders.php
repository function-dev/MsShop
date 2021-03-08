<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $guarded = [];
    protected $table = 'orders';

    public function orders_product()
    {
        return $this->hasMany('App\orders_product', 'orders_id');
    }

}
