<?php

namespace App\Models;

use App\Observers\ProductCreated;
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
        'created' => ProductCreated::class
    ];
}
