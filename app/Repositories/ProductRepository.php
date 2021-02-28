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
//    ЗАКОНЧИИ ЭТУ ХУЕТУ ПЛЗ <3
    public function getAttr(){
        $jdf = $this->startConditions()->find(1);
        return $this->startConditions()->find(1)->attrs[0]->id;
    }
}
