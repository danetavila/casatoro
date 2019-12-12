<?php

namespace App\Observers;

use App\Models\Sale;
use App\Modules\Inventory;

class SaleCreated
{
    public function __construct(Sale $sale)
    {
        (new Inventory($sale, (int) request()->get('qty')))->update();
    }
}
