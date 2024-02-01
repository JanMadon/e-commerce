<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateCategoryRequest extends FormRequest
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
    public function rules(Request $request): array
    {
       // dd($this);
        if($request->parentId) {
            return [
                'parentId' => ['required', 'integer', 'exists:categories,id'],
                'name' => ['required','string','unique:sub_categories' ,' min:3', 'max:20', ],
                'description' => ['nullable', 'string', 'max:150']
            ];
        }

        return [
            'name' => ['required','string','unique:categories' ,' min:3', 'max:20', ],
            'description' => ['nullable', 'string', 'max:150']
        ];
    }

    public function messages() :array
    {
         return [
            'name.required' => 'A name is requires',
            'name.unique' => 'Category arledy exists',
            'name.min' => 'A name have to minimum :min chracters',
            'name.max' => 'A name have to maximum :max chracters',
            'description.max' => 'A description have to maximum :max chracters'
         ];
    }


}
