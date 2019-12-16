<?php

namespace App\Modules;

use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory as InventoryModel;
use App\Models\Product;
use App\Models\Sale;

/**
 * Class Inventory
 * @package App\Modules
 */
class Inventory
{
    /**
     * @var Product
     * @var sale
     */
    private $model;
    private $row1=[0, 0, 0, 0, 0];
    private $row2=[0, 0, 0, 0, 0];
    private $row3=[0, 0, 0, 0, 0];
    private $row4=[0, 0, 0, 0, 0];

    /**
     * @var int
     */
    private $qty;


    public function __construct(Model $model, int $qty)
    {
        $this->model = $model;
        $this->qty = $qty;

    }

    public function store()
    {
        for ($i = 0; $i < $this->qty; $i++) {
            $inventory = new InventoryModel;
            $inventory->product_id = $this->model->id;
            $inventory->position = $this->getPositionAvailable();
            $inventory->save();
        }
    }

    public function update()
    {
        for ($i = 0; $i < $this->qty; $i++) {
           $updatePosition=$this->saleLock();
            if(is_int($updatePosition)){
                $change=InventoryModel::where(['product_id' =>$this->model->product_id, 'sale_id' => null,'position' => $updatePosition])->update(['sale_id' =>$this->model->id]);
            }else{
                $position=explode('-',$updatePosition);
                $change=InventoryModel::where(['product_id' =>$this->model->product_id, 'sale_id' => null,'position' => $position[1]])->update(['sale_id' =>$this->model->id]);
                $change=InventoryModel::where(['sale_id' => null,'position' => $position[0]])->update(['position' =>$position[1]]);
            }
        }
    }
    
    protected function fillPositionAvailable()
    {
        $this->row1=[0, 0, 0, 0, 0];
        $this->row2=[0, 0, 0, 0, 0];
        $this->row3=[0, 0, 0, 0, 0];
        $this->row4=[0, 0, 0, 0, 0];
        $position="";
        $inventory = InventoryModel::whereNull('sale_id')
            ->orderByDesc('position')
            ->get();

        if(count($inventory) > 0){
            foreach ($inventory as  $product) {
                if($product->position <= 5){
                    $this->row1[$product->position-1] = 1;
                }else{
                    if(($product->position > 5) && ($product->position <= 10)){
                        $this->row2[$product->position-6] = 1;
                    }else{
                        if(($product->position > 10) && ($product->position <= 15)){
                            $this->row3[$product->position-11] = 1;
                        }else{
                            if(($product->position > 15) && ($product->position <= 20)){
                                $this->row4[$product->position-16] = 1;
                            }
                        }
                    }
                }
            }
        }
    }

    protected function getPositionAvailable()
    {
        $position="";
        $this->fillPositionAvailable();
        for ($i=1; $i <= 4; $i++) {
            $filtered=array_keys($this->{'row'.$i}, 0);
            if(count($filtered)>0){
                $y=array_rand($filtered,1);
                $position=$filtered[$y];
                $x[$position]=1;
                switch ($i) {
                    case '1':
                        $position=$position+1;
                        break;
                    case '2':
                        $position=$position+6;
                        break;
                    case '3':
                        $position=$position+11;
                        break;
                    case '4':
                        $position=$position+16;
                        break;
                }
                break;
            }
        }
        return $position;
    }

    protected function saleLock()
    {
        $products = InventoryModel::where(['product_id' => $this->model->product_id, 'sale_id' => null])
            ->take(1)
            ->orderBy('created_at')
            ->get();

        $positionAvailable = InventoryModel::whereNull('sale_id')
            ->count();

        if(count($products) > 0){
            $var=0;
            $band=0;
            foreach ($products as  $product) {
                do
                {
                    $this->fillPositionAvailable();
                    if($product->position <= 5){
                        if($this->row2[$product->position-1]==1){
                            if($positionAvailable==20){
                                //cambiar por la que se va a vender
                                $band=0; $var=5;
                                $changePosition=$var+$product->position;
                                $x=$changePosition.'-'.$product->position;
                                return $x;
                            }else{
                                $band=1; $var=5;
                                if($this->row3[$product->position-1]==1){
                                    $band=1; $var=10;
                                    if($this->row4[$product->position-1]==1){
                                        $band=1; $var=15;
                                    }
                                }
                            }
                        }else{
                            $band=0;
                            //se hace update de sale_id
                            return $product->position;
                        }
                    }else{
                        if(($product->position > 5) && ($product->position <= 10)){
                            $band=1; $var=0;
                            if($this->row3[$product->position-6]==1){
                                $band=1; $var=5;
                                if($positionAvailable==20){
                                    //cambiar por la que se va a vender
                                    $band=0;
                                    $changePosition=$var+$product->position;
                                    $x=$changePosition.'-'.$product->position;
                                    return $x;
                                }else{
                                    if($this->row4[$product->position-6]==1){
                                        $band=1; $var=10;
                                    }
                                }

                            }else{
                                $band=0;
                                //se hace update de sale_id
                                return $product->position;
                            }
                        }else{
                            if(($product->position >= 11) && ($product->position <= 15)){
                                $band=0; $var=0;
                                if($this->row4[$product->position-11]==1){
                                    $band=1; $var=5;
                                    if($positionAvailable==20){
                                        //cambiar por la que se va a vender
                                        $band=0;
                                        $changePosition=$var+$product->position;
                                        $x=$changePosition.'-'.$product->position;
                                        return $x;
                                    }
                                }else{
                                    $band=0;
                                    //se hace update de sale_id
                                    return $product->position;
                                }
                            }else{
                                if(($product->position >= 16) && ($product->position <= 20)){
                                    $band=0;
                                    //se hace update de sale_id
                                    return $product->position;
                                }
                            }
                        }
                    }
                    if($band==1)
                    { //buscomposicion y cambio el qu me obstruye el caminoS
                        $newPosition=$this->getPositionAvailable();
                        $changePosition=$var+$product->position;
                        $change=InventoryModel::where(['sale_id' => null,'position' => $changePosition])->update(['position' =>$newPosition]);

                    }
                }while(true);
            }
        }
    }
}
