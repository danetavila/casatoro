<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'qty', 'product_id'
    ];
}
