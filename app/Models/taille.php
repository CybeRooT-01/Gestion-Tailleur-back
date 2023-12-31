<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class taille extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ["libelle"];
    protected $hidden = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tailles');
    }
}
