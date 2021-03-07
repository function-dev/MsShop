<?php

namespace App\Repositories;
use App\products as Model;
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
    public function getSearch($string){
        if (empty($string)){
            return 0;
        }
        return $this->startConditions()
            ->where('name', 'like', $string)
            ->get();
    }
}
