<?php

namespace App\Http\Requests;

use App\Rules\TheQuantityProductMustNotExceedAvailable;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => 'required|string',
            'price' => 'required|numeric',
            'qty' => ['nullable', 'numeric', 'min:0', new TheQuantityProductMustNotExceedAvailable()],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del producto es requerido.',
            'price.required' => 'El precio del producto es requerido.',
            'qty.numeric' => 'La cantidad del producto debe ser de tipo numérico.',
            'qty.min' => 'La cantidad debe ser mayor o igual a 0.',
        ];
    }
}
