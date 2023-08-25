<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'libelle',
        'prix',
        'stock',
        'image',
        'categorie_id',
        'fournisseur_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'reference'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }
    public function fournisseurs()
    {
        return $this->belongsToMany(Fournisseur::class, 'article_fournisseurs');
    }
    

    // protected static function booted()
    // {
    //     static::created(function ($article) {
    //         $categori = $article->categorie_id;
    //         $existingArticleNbr = $categori->articles->count();
    //         if ($existingArticleNbr > 1){
    //             $categori->increment('ordre_insertion');
    //         }else{
    //             $categori->update(['ordre_insertion' => 1]);
    //         }
    //     });
    // }
}
