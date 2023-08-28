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
    public function getCategoriesConf(){
        $categories = Categorie::where('type_categorie', 'confection')->get();
        return response()->json($categories, JsonResponse::HTTP_OK);
    }
    public function getCategoryFournisseurArticle()
    {
        $articles = Article::with('categorie')->with('fournisseurs')->get();
        $categories = Categorie::where('type_categorie', 'vente')->get();
        $fournisseurs = Fournisseur::all();

        $data = [
            'articles' => $articles,
            'categories' => $categories,
            'fournisseurs' => $fournisseurs
        ];
        // dd($data);

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
            $ListeFournisseur = [];
            foreach ($fournisseurs as $fournisseur) {
                $ListeFournisseur[] = [
                    'article_id' => $article->id,
                    'fournisseur_id' => $fournisseur
                ];
            }
            ArticleFournisseur::insert($ListeFournisseur);
            DB::commit();
            return response()->json([
                'id' => $article->id,
                'article' => $article,
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
    public function update(ArticlePostRequest $request, string $id){
        $article = Article::where('id', $id)->first();
        $articleFournisseur = ArticleFournisseur::where('article_id', $id)->get();
        if (!$article) {
            return response()->json([
                'message' => 'Article non trouvé'
            ], JsonResponse::HTTP_NOT_FOUND);
        }
        try {
            DB::beginTransaction();
            $libelle = $request->libelle;
            $prix = $request->prix;
            $stock = $request->stock;
            $image = $request->image;
            $reference = $request->reference;
            $categorie = $request->categorie;
            $fournisseurs = $request->fournisseur;

            $article->update([
                'libelle' => $libelle,
                'prix' => $prix,
                'stock' => $stock,
                'image' => $image,
                'reference' => $reference,
                'categorie_id' => $categorie,
            ]);
            foreach ($articleFournisseur as $fournisseur) {
                $fournisseur->delete();
            }
            $listeFournisseurs = [];
            foreach ($fournisseurs as $fournisseur) {
                $listeFournisseurs[] = [
                    'article_id' => $article->id,
                    'fournisseur_id' => $fournisseur
                ];
            }
            ArticleFournisseur::insert($listeFournisseurs);
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Une erreur est survenue lors de la modification de l\'article',
                'error' => $th->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([
            'message' => 'Article modifié avec succès'
        ], JsonResponse::HTTP_OK);
    }
}
