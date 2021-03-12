<?php


namespace App\Repositories;
use App\attr as Model;
use http\Env\Response;
use Illuminate\Database\Eloquent\Collection;

class AttrRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }
    public function addNewAttr($product_id, $name, $value){
        $this->startNewModel()->create([
            'product_id' => $product_id,
            'name' => $name,
            'value' => $value,
        ])->save();
        return $this->startConditions()->orderby('id', 'desc')->first();
    }

    public function updateAttr($product_id, $data){
        foreach ($data as $item){
            if ($item['product_id'] == $product_id){
                $this->startConditions()->where('id', $item['id'])->update([
                    'name' => $item['name'],
                    'value'=>$item['value']
                ]);
            }
        }


    }
}
