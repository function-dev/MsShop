<?php

namespace App\Repositories;
use App\collection_list as Model;
use Illuminate\Database\Eloquent\Collection;

class CollectionRepository extends CoreRepository
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
    public function getAllCollection(){
        return $this->startConditions()->all();
    }
}
