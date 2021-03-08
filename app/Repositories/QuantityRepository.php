<?php


namespace App\Repositories;
use App\quantity as Model;
use http\Env\Response;
use Illuminate\Database\Eloquent\Collection;

class QuantityRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }
    public function addNewQuantity($product_id, $size, $quantity){
        $this->startNewModel()->create([
            'product_id' => $product_id,
            'size' => $size,
            'quantity' => $quantity,
        ])->save();
        return $this->startConditions()->orderby('id', 'desc')->first();
    }
}
