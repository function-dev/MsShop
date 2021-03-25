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
//, $changeableColumnName, $value
    public function lineChangesByTooColumns($sortColumnName, $sortColumnValue, $sortColumnName2, $sortColumnValue2, $changeableColumnName, $value){
        $a = 0;
        $item = $this->startConditions()
            ->where($sortColumnName, $sortColumnValue)
            ->where($sortColumnName2, $sortColumnValue2)
            ->get();
        foreach ($item as $i){
            $a = $i->$changeableColumnName - $value;
            $i->update([
                $changeableColumnName => $a
            ]);
        }

    }

    public function updateQuantity($product_id, $data){
        foreach ($data as $item){
            if ($item['product_id'] == $product_id){
                $this->startConditions()->where('id', $item['id'])->update([
                    'size' => $item['size'],
                    'quantity'=>$item['quantity']
                ]);
            }
        }
    }
}
