<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticlePostRequest extends FormRequest
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
            'libelle' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'required|string',
            'reference'=>'required'
        ];
    }
    public function messages(){
        return [
            'libelle.required' => 'Le libelle est obligatoire',
            'libelle.string' => 'Le libelle doit être une chaine de caractères',
            'libelle.max' => 'Le libelle ne doit pas dépasser 255 caractères',
            'prix.required' => 'Le prix est obligatoire',
            'prix.numeric' => 'Le prix doit être un nombre',
            'stock.required' => 'Le stock est obligatoire',
            'stock.numeric' => 'Le stock doit être un nombre',
            'image.required' => 'L\'image est obligatoire',
            'image.string' => 'L\'image doit être une chaine de caractères',
            'reference.required'=>'La reference est obligatoire'
        ];
    }
}
