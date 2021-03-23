<?php

namespace App\Repositories;
use App\orders as Model;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }


    public function getAllLine(){
        return $this->startConditions()->all();
    }

    public function addNewOrder($surname, $name, $patronymic, $tel, $mail, $address, $index, $comment){
        $this->startNewModel()->create([
            'surname' => $surname,
            'name' => $name,
            'patronymic' => $patronymic,
            'tel' => $tel,
            'mail' => $mail,
            'address' => $address,
            'index' => $index,
            'comment' => $comment,
        ])->save();
        return $this->startConditions()->orderby('id', 'desc')->first();
    }

    public function dellOrder($id){
        $this->startConditions()->where('id', $id)->delete();
    }



}
