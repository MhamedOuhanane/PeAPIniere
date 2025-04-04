<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanteRequest extends FormRequest
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
        $plante = $this->route('plante');
        return [
            'name'=> ['required', 'string', 'unique:plantes,name,' . $plante->id], 
            'description'=> ['required', 'string', 'min:20'], 
            'prix'=> ['required', 'numeric', 'between:9.99,299.99'], 
            'categorie_id'=> ['required', 'integer', 'exists:categories,id'],
        ];
    }
}
