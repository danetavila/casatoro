<?php

namespace App\Models;

use App\Observers\InventoryCreated;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'price'
    ];

    /**
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => InventoryCreated::class
    ];
}
