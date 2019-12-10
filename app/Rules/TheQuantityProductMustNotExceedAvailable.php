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
        $this->available = (env('POSITIONS') - Inventory::whereNull('sale_id')->count());
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
        return $value < $this->available;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Solo quedan disponible {$this->available} posiciones.";
    }
}
