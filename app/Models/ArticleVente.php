<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleVente extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'libelle',
        'categorie',
        'reference',
        'quantite',
        'valeur_promo',
        'cout_fabrication',
        'prix_vente',
        'marge',
        'article_confection_id',
        'quantite_stock',
        'image',
    ];
}
