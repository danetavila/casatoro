<?php

namespace App\Rules;

use App\Models\Inventory;
use Illuminate\Contracts\Validation\Rule;

class TheQuantityProductMustNotExceedAvailable implements Rule
{
    /**
     * @var int
     */
    protected $available;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $cant=Inventory::whereNull('sale_id')->count();
        $this->available = (env('POSITIONS') -  $cant);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value <= $this->available;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Solo quedan {$this->available} posiciones disponible para ingresar en el inventario.";
    }
}
