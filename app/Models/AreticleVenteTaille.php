<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreticleVenteTaille extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable =[
        "article_vente_id",
        "taille_id"
    ];
    protected $hidden = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];
    public function articleVente()
    {
        return $this->belongsTo(ArticleVente::class, 'article_vente_id');
    }
    public function taille()
    {
        return $this->belongsTo(Taille::class, 'taille_id');
    }
    
}
