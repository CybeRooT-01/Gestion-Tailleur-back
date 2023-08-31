<?php

namespace App\Http\Controllers;

use App\Http\Requests\articleVenteRequest;
use App\Http\Resources\articleventeRessource;
use App\Models\AreticleVenteTaille;
use App\Models\ArticleVente;
use App\Models\taille;
use App\Models\VenteConf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\JsonResponse;

class ArticleVenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = ArticleVente::with('venteConf')->get();
        return articleventeRessource::collection($articles);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(articleVenteRequest $request)
    {
        try {
            DB::beginTransaction();
            $libelle = $request->libelle;
            $image = $request->image;
            $categorie = $request->categorie;
            $cout_Fabrication = $request->cout_fabrication;
            $marge = $request->marge;
            $prix_vente = $request->prix_vente;
            $promo = $request->promo;
            $reference = $request->reference;
            $articles = $request->article;
            $taille = $request->tailles;
            // dd($promo); me donne la valeur de promo dans le request
            $articlevente = ArticleVente::create([
                'libelle' => $libelle,
                'image' => $image,
                'categorie_id' => $categorie,
                'cout_fabrication' => $cout_Fabrication,
                'marge' => $marge,
                'prix_vente' => $prix_vente,
                'reference' => $reference,
                'promo' => $promo,
            ]);
            $ListeArticle = [];
            foreach ($articles as $article) {
                $ListeArticle[] = [
                    'article_conf_id' => $article['id'],
                    'article_vente_id' => $articlevente->id,
                    'quantite' => $article['quantite'],
                ];
            }
            VenteConf::insert($ListeArticle);

            AreticleVenteTaille::create([
                'article_vente_id'=> $articlevente->id,
                'taille_id'=>$taille
            ]);
            DB::commit();
            return response()->json(['message' => 'Article de vente enregistré avec succès'], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $article = ArticleVente::with('venteConf')->with('articleVenteTaille')->find($id);
        if (!$article) {
            return response()->json([
                'message' => 'Article non trouvé'
            ], JsonResponse::HTTP_NOT_FOUND);
        }
        return new articleventeRessource($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $article = ArticleVente::find($id);
            if (!$article) {
                return response()->json([
                    'message' => 'Article non trouvé'
                ], JsonResponse::HTTP_NOT_FOUND);
            }
            $article->update($request->all());
            $article->venteConf()->detach();
            $articles = $request->article;
            $ListeArticle = [];
            foreach ($articles as $article) {
                $ListeArticle[] = [
                    'article_conf_id' => $article['id'],
                    'article_vente_id' => $id,
                    'quantite' => $article['quantite'],
                ];
            }
            VenteConf::insert($ListeArticle);
            DB::commit();
            return response()->json(['message' => 'Article de vente modifié avec succès'], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!ArticleVente::find($id)) {
            return response()->json([
                'message' => 'Article non trouvé'
            ], JsonResponse::HTTP_NOT_FOUND);
        }
        ArticleVente::destroy($id);
        return response()->json([
            'message' => 'Article supprimé avec succès'
        ], JsonResponse::HTTP_OK);
    }
    public function getAllTailles()
    {
        $tailles = taille::all();
        return response()->json([
            'message' => 'Liste des tailles recuperes avec succes',
            'tailles' => $tailles
        ]);
    }
}
