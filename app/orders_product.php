<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orders_product extends Model
{
    protected $guarded = [];
    protected $table = 'orders_product';

    public function orders()
    {
        return $this->belongsTo('App\orders');
    }
    public function products()
    {
        return $this->belongsTo('App\products');
    }
    public function collection_lists()
    {
        return $this->belongsTo('App\collection_lists');
    }
}
