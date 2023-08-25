<?php

namespace App\Http\Controllers;

use App\Http\Requests\articleVenteRequest;
use App\Http\Resources\articleventeRessource;
use App\Models\ArticleVente;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class ArticleVenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = ArticleVente::all();
        $message = 'Liste des articles de vente récupérée avec succès.';

        return response()->json([
            'message' => $message,
            'data' => articleventeRessource::collection($articles),
        ], HttpResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(articleVenteRequest $request)
    {
        $article = new ArticleVente();
        $article->libelle = $request->libelle;
        $article->categorie = $request->categorie;
        $article->reference = $request->reference;
        $article->quantite = $request->quantite;
        $article->valeur_promo = $request->valeur_promo;
        $article->cout_fabrication = $request->cout_fabrication;
        $article->prix_vente = $request->prix_vente;
        $article->marge = $request->marge;
        $article->article_confection_id = $request->article_confection_id;
        $article->quantite_stock = $request->quantite_stock;
        $article->image = $request->image;
        $article->save();
        $message = 'Article de vente ajouté avec succès.';

        return response()->json([
            'message' => $message,
            'data' => new articleventeRessource($article),
        ], HttpResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(articleVenteRequest $request, string $id)
    {
        $article = ArticleVente::find($id);
        if (!$article) {
            $message = 'Article de vente non trouvé.';

            return response()->json([
                'message' => $message,
            ], HttpResponse::HTTP_NOT_FOUND);
        }
        $article->libelle = $request->libelle;
        $article->categorie = $request->categorie;
        $article->reference = $request->reference;
        $article->quantite = $request->quantite;
        $article->valeur_promo = $request->valeur_promo;
        $article->cout_fabrication = $request->cout_fabrication;
        $article->prix_vente = $request->prix_vente;
        $article->marge = $request->marge;
        $article->article_confection_id = $request->article_confection_id;
        $article->quantite_stock = $request->quantite_stock;
        $article->image = $request->image;
        $article->save();
        $message = 'Article de vente modifié avec succès.';

        return response()->json([
            'message' => $message,
            'data' => new articleventeRessource($article),
        ], HttpResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = ArticleVente::find($id);
        if (!$article) {
            $message = 'Article de vente non trouvé.';

            return response()->json([
                'message' => $message,
            ], HttpResponse::HTTP_NOT_FOUND);
        }
        $article->delete();
        $message = 'Article de vente supprimé avec succès.';

        return response()->json([
            'message' => $message,
        ], HttpResponse::HTTP_OK);
    }
}
