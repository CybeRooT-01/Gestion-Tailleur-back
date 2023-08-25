<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_fournisseurs');
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
