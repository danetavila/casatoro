<?php

namespace App\Http\Requests;

use App\Rules\TheQuantityProductMustNotExceedAvailable;
use Illuminate\Foundation\Http\FormRequest;

class InventoryStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required|numeric',
            'qty' => ['required', 'numeric', 'min:1', new TheQuantityProductMustNotExceedAvailable()],
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'El producto es requerido.',
            'product_id.numeric' => 'El valor del producto debe ser de tipo numérico.',
            'qty.required' => 'La cantidad del producto es requerida.',
            'qty.numeric' => 'La cantidad del producto debe ser de tipo numérico.',
            'qty.min' => 'La cantidad debe ser mayor a 0.',
        ];
    }
}
