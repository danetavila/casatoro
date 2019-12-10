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
        $position = 0;

        $inventory = InventoryModel::whereNull('sale_id')
            ->orderByDesc('position')
            ->get();

        if ($inventory->count() > 0) {
            $rows = collect([0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]);

            $inventory->each(function ($product) use (&$rows) {
                $rows[$product->position] = 1;
            });

            $rows = $rows->filter(function ($row) {
                return $row === 0;
            });

            $position = $rows->chunk(4)->first()->keys()->random();
        } else {
            $position = rand(1, 5);
        }

        return $position;
    }
}
