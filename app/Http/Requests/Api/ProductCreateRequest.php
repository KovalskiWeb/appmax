<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'title' => 'required',
            'stock' => 'required',
            'sku' => 'required',
            'price' => 'required',
            'image' => 'nullable|image',
            'description' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Campo título é obrigatório!',
            'stock.required' => 'Campo estoque é obrigatório!',
            'sku.required' => 'Campo SKU é obrigatório!',
            'price.required' => 'Campo preço é obrigatório!',
            'image.image' => 'Só é permitido o envio de imagem!',
            'description.required' => 'Campo descrição é obrigatório!',
        ];
    }
}
