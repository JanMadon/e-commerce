<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
      //  dd('stop');
        return [
            'name'=>['required', 'string', 'min:5', 'max:50', 'unique:products'],
            'category_id'=>['required', 'integer', 'exists:categories,id', 'exists:sub_categories,category_id'],
            'subcategory_id'=>['required', 'integer', 'exists:sub_categories,id'],
            'quantity'=>['required'],
            'price'=>['required', 'numeric', 'min:0.01',],
            'description'=>['required', 'string', 'min:10', 'max:250'],
            'photos'=>['required']
        ];
    }
}
