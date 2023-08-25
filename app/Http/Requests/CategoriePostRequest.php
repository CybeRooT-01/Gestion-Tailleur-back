<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'libelle' => 'required|string|min:3',
            'type_categorie' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'libelle.required' => 'Le libelle est obligatoire',
            'libelle.string' => 'Le libelle doit être une chaine de caractères',
            'libelle.min' => 'Le libelle doit contenir au moins 3 caractères',
            'type_categorie.required' => 'Le type de catégorie est obligatoire'
        ];
    }
}
