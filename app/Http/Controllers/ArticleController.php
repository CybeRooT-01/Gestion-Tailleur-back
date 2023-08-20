<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\JsonResponse;
use App\Models\ArticleFournisseur;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ArticlePostRequest;
use App\Models\Fournisseur;

class ArticleController extends Controller
{
    public function getCategoryFournisseurArticle()
    {
        $articles = Article::with('categorie')->get();
        $categories = Categorie::all();
        $fournisseurs = Fournisseur::all();

        $data = [
            'articles' => $articles,
            'categories' => $categories,
            'fournisseurs' => $fournisseurs
        ];

        return response()->json($data, JsonResponse::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ArticlePostRequest $request)
    {
        try {
            DB::beginTransaction();
            $libelle = $request->libelle;
            $prix = $request->prix;
            $stock = $request->stock;
            $image = $request->image;
            $reference = $request->reference;
            $categorie = $request->categorie;
            $fournisseurs = $request->fournisseur;

            $article = Article::create([
                'libelle' => $libelle,
                'prix' => $prix,
                'stock' => $stock,
                'image' => $image,
                'reference' => $reference,
                'categorie_id' => $categorie,
            ]);
            foreach ($fournisseurs as $fournisseur) {
                ArticleFournisseur::create([
                    'article_id' => $article->id,
                    'fournisseur_id' => $fournisseur
                ]);
            }
            DB::commit();
            return response()->json([
                'message' => 'Article créé avec succès',
                'lastAdded' => Article::latest()->first()
            ], JsonResponse::HTTP_CREATED);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Une erreur est survenue lors de la création de l\'article',
                'error' => $th->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function destroy($id)
    {
        if (!Article::find($id)) {
            return response()->json([
                'message' => 'Article non trouvé'
            ], JsonResponse::HTTP_NOT_FOUND);
        }
        Article::destroy($id);
        return response()->json([
            'message' => 'Article supprimé avec succès'
        ], JsonResponse::HTTP_OK);
    }
}
