<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlanteRequest extends FormRequest
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
            'name'=> ['required', 'string', 'unique:plantes,name'], 
            'description'=> ['required', 'string', 'min:20'], 
            'prix'=> ['required', 'decimal:9.99,299.99'], 
            'categorie_id'=> ['required', 'integer', 'exists:categories,id'],
            'image' => ['required', 'file', 'mimes:png,jpg'],
        ];
    }
}
