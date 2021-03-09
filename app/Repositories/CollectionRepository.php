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
    public function getAllLine(){
        return $this->startConditions()->all();
    }
    public function addNewCollection($name){
        $this->startNewModel()->create([
            'name' => $name,
        ])->save();
        return $this->startConditions()->orderby('id', 'desc')->first();
    }
    public function dellCollection($id){
        $this->startConditions()->where('id', $id)->delete();
    }
    public function updateCollection($id, $name){
        $this->startConditions()->where('id', $id)->update([
            'name'=>$name
        ])->save();
    }
}
