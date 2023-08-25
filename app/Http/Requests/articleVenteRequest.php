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
            'libelle' => 'required|string',
            'categorie' => 'required|string',
            'reference' => 'required|string',
            'quantite' => 'required|integer',
            'valeur_promo' => 'required|integer',
            'cout_fabrication' => 'required|integer',
            'prix_vente' => 'required|integer',
            'marge' => 'required|integer',
            'article_confection_id' => 'required|integer',
            'quantite_stock' => 'required|integer',
            'image' => 'required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'libelle.required' => 'Le libelle est obligatoire',
            'categorie.required' => 'La categorie est obligatoire',
            'reference.required' => 'La reference est obligatoire',
            'quantite.required' => 'La quantite est obligatoire',
            'valeur_promo.required' => 'La valeur promo est obligatoire',
            'cout_fabrication.required' => 'Le cout de fabrication est obligatoire',
            'prix_vente.required' => 'Le prix de vente est obligatoire',
            'marge.required' => 'La marge est obligatoire',
            'article_confection_id.required' => 'L\'article de confection est obligatoire',
            'quantite_stock.required' => 'La quantite en stock est obligatoire',
            'image.required' => 'L\'image est obligatoire',
        ];
    }
}
