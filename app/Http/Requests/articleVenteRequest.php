<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class articleVenteRequest extends FormRequest
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
            'libelle' => 'required|string|unique:article_ventes',
            'image' => 'required|string',
            'categorie' => 'required|integer',
        ];
    }
    public function messages(): array
    {
        return [
            'libelle.required' => 'Le libelle est obligatoire',
            'libelle.string' => 'Le libelle doit être une chaine de caractère',
            'libelle.unique' => 'Le libelle doit être unique',
            'image.required' => 'L\'image est obligatoire',
            'image.string' => 'L\'image doit être une chaine de caractère',
            'categorie.required' => 'La categorie est obligatoire',
            'categorie.integer' => 'La categorie doit être un entier',
        ];
    }

}
