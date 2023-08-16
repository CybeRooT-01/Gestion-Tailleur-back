<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ArticlePostRequest;

class ArticleController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ArticlePostRequest $request):JsonResponse
    {
        $libelle =$request->libelle;
        $prix = $request->prix;
        $stock = $request->stock;
        $image = $request->image;
        $reference = $request->reference;
        $categorie = $request->categorie;
        $fournisseur= $request->fournisseur;
        Article::create([
            'libelle' => $libelle,
            'prix' => $prix,
            'stock' => $stock,
            'image' => $image,
            'reference' => $reference,
            'categorie_id'=> $categorie,
            'fournisseur_id'=> $fournisseur
        ]);
        return response()->json([
            'message' => 'Article ajouté avec succès'
        ]);

    }
}
