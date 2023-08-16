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
}
