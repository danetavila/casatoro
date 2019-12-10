<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'position', 'product_id', 'sale_id'
    ];
}
