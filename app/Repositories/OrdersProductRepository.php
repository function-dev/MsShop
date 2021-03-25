<?php

namespace App\Repositories;
use App\orders_product as Model;
use Illuminate\Database\Eloquent\Collection;

class OrdersProductRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    public function getOrderByOrderId($orderId){
        return $this->startConditions()->where('order_id', $orderId)->get();
    }


    public function getAllLine(){
        return $this->startConditions()->all();
    }

    public function addNewOrderProduct($order_id, $product_id, $quantity, $price, $size){
        $this->startNewModel()->create([
            'order_id' => $order_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $price,
            'size' => $size,
        ])->save();
        return $this->startConditions()->orderby('id', 'desc')->first();
    }

    public function dellOrderProduct($id){
        $this->startConditions()->where('id', $id)->delete();
    }



}
