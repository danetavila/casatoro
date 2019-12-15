<?php

namespace App\Models;

use App\Observers\SaleCreated;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'qty', 'product_id'
    ];

     /**
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => SaleCreated::class
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}
