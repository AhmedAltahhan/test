<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' =>['nullable','string','min:3','max:20'],
            'username' => ['nullable','unique:users,username','min:4','max:10'],
            'is_active' =>['nullable','integer'],
            'type' => ['nullable','in:normal,gold,silver'],
            'image' => ['nullable','mimes:png,jpg,jpeg']
        ];
    }
}
