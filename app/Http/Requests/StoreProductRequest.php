<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        return [
            'product' => ['nullable','exists:products,id'],
            'name' => ['required_without:product','unique:products,name','string','min:3','max:20'],
            'description' => ['required_without:product','min:5','max:1800'],
            'price' => ['required_without:product','numeric'],
            'slug' => ['required_without:product','unique:products,slug','string','min:3','max:15'],
            'is_active' =>['required_without:product','integer'],
            'image' => ['required_without:product','mimes:png,jpg,jpeg']
        ];
    }
}
