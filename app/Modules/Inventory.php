<?php

namespace App\Modules;

use App\Models\Inventory as InventoryModel;
use App\Models\Product;

/**
 * Class Inventory
 * @package App\Modules
 */
class Inventory
{
    /**
     * @var Product
     */
    private $product;

    /**
     * @var int
     */
    private $qty;

    public function __construct(Product $product, int $qty)
    {
        $this->product = $product;
        $this->qty = $qty;
    }

    public function store()
    {
        for ($i = 0; $i < $this->qty; $i++) {
            $inventory = new InventoryModel;
            $inventory->product_id = $this->product->id;
            $inventory->position = $this->getPositionAvailable();
            $inventory->save();
        }
    }

    /**
     * @return int
     */
    protected function getPositionAvailable()
    {
        $row1=[0, 0, 0, 0, 0];
        $row2=[0, 0, 0, 0, 0];
        $row3=[0, 0, 0, 0, 0];
        $row4=[0, 0, 0, 0, 0];

        $position="";

        $inventory = \App\Models\Inventory::whereNull('sale_id')
            ->orderByDesc('position')
            ->get();

        if(count($inventory) > 0){
            foreach ($inventory as  $product) {
                if($product->position <= 5){
                    $row1[$product->position-1] = 1;
                }else{
                    if(($product->position > 5) && ($product->position <= 10)){
                        $row2[$product->position-6] = 1;
                    }else{
                        if(($product->position > 10) && ($product->position <= 15)){
                            $row3[$product->position-11] = 1;
                        }else{
                            if(($product->position > 15) && ($product->position <= 20)){
                                $row4[$product->position-16] = 1;
                            }
                        }
                    }
                }
            }

            for ($i=1; $i <= 4; $i++) {
                $filtered=array_keys(${'row'.$i}, 0);
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
        } else {
            $position=rand(0,4);
            $row1[$position]=1;
            $position++;
        }

        return $position;
    }
}
