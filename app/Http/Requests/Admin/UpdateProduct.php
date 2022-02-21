<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduct extends FormRequest
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
        $rules = [
            'title' => 'required',
            'stock' => 'required',
            'sku' => 'required',
            'price' => "required",
            'image' => 'image',
            'description' => ['required'],
        ];

        if ($this->method() == 'PUT') {
            $rules['image'] = ['nullable', 'image'];
        }

        return $rules;
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
            'sku.required' => 'Campo sku é obrigatório!',
            'price.required' => 'Campo preço é obrigatório!',
            'description.required' => 'Campo descrição é obrigatório!',
        ];
    }
}
