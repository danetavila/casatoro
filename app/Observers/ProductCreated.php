<?php

namespace App\Observers;

use App\Models\Product;
use App\Modules\Inventory;

class ProductCreated
{
    public function __construct(Product $product)
    {
        (new Inventory($product, (int) request()->get('qty')))->store();
    }
}
