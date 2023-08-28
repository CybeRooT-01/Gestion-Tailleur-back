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
            // 'image' => $this->image,
            'marge'=>$this->marge,
            'prix_vente'=>$this->prix_vente,
            'reference'=>$this->reference,
            'cout_fabrication'=>$this->cout_fabrication,
            'promo'=>$this->promo,
            'categorie'=>$this->categorie,
            'articles' => $this->whenLoaded('venteConf', function () {
            return $this->venteConf->map(function ($articleConf) {
                return [
                    'libelle' => $articleConf->libelle,
                    'quantite' => $articleConf->pivot->quantite,
                    'id' => $articleConf->id,
                ];
            });
        }),
        ];
    }
}
