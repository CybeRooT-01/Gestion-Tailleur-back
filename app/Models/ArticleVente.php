<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleVente extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'categorie_id',
        'marge',
        'quantite',
        'prix_vente',
        'reference',
        'image',
        'cout_fabrication',
    ];
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function venteConf()
    {
        return $this->belongsToMany(Article::class, 'vente_confs', 'article_vente_id', 'article_conf_id')->withPivot('quantite');
    }

}
