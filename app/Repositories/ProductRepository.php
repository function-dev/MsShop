<?php

namespace App\Repositories;
use App\products as Model;
use http\Env\Response;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }
//    Получить запись по id
//    id int
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }
//    Получить все записи из бд
    public function getAllLine(){
        return $this->startConditions()->all();
    }
//    Получить всю информацию о всех продуктах
    public function getAllInfo()
    {
          $allInfo = [];
          $allProducts = $this->startConditions()->all();

          foreach ($allProducts as $product)
          {

              array_push($allInfo, $product );
              array_push($allInfo, $product->attrs );
              array_push($allInfo, $product->quantities );

          }

          return $allProducts;

    }

    public function getAllInfoById($id){
        $allInfo = [];
        $allProducts = $this->startConditions()->where('id',$id)->get();

        foreach ($allProducts as $product)
        {

            array_push($allInfo, $product );
            array_push($allInfo, $product->attrs );
            array_push($allInfo, $product->quantities );

        }

        return $allProducts;
    }

    public function getSearch($string){
        if (empty($string)){
            return $this->startConditions()->all();
        }

        $return = $this->startConditions()->where('name', 'like', '%'.$string.'%')->get();

        return $return;
    }

    public function addNewProduct($collection_id, $name, $desc, $img, $price){

        $this->startNewModel()->create([
            'collection_id' => $collection_id,
            'name' => $name,
            'desc' => $desc,
            'img' => $img,
            'price' => $price,
        ])->save();
        return $this->startConditions()->orderby('id', 'desc')->first();
    }


    public function updateProduct($id, $collection_id,$name, $desc, $img, $price){
        $this->startConditions()->where('id', $id)->update([
            'collection_id' => $collection_id,
            'name' => $name,
            'desc' => $desc,
            'img' => $img,
            'price' => $price
        ])->save();
        return $id;
    }


    public function dellProduct($id){
        $this->startConditions()->where('id', $id)->delete();
    }



}
