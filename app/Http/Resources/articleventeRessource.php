<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class articleventeRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            
            'id' => $this->id,
            'libelle' => $this->libelle,
            'categorie' => $this->categorie,
            'reference' => $this->reference,
            'quantite' => $this->quantite,
            'valeur_promo' => $this->valeur_promo,
            'cout_fabrication' => $this->cout_fabrication,
            'prix_vente' => $this->prix_vente,
            'marge' => $this->marge,
            'article_confection_id' => $this->article_confection_id,
            'quantite_stock' => $this->quantite_stock,
            'image' => $this->image,
        ];
    }
}
