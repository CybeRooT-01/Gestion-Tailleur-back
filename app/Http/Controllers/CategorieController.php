<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriePostRequest;
use App\Models\Categorie;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = Categorie::paginate(5);
        $categories = Categorie::all();
        return $categories;
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriePostRequest $request)
    {
        $categorieName = $request->input('libelle');
        $existingDeletedCategorie = Categorie::onlyTrashed()->where('libelle', $categorieName)->first();
        if ($existingDeletedCategorie) {
            $existingDeletedCategorie->restore();
            return response()->json([
                'message' => 'Catégorie restaurée avec succès'
            ], Response::HTTP_OK);
        }
        $existingCategorie = Categorie::where('libelle', $categorieName)->first();
        if ($existingCategorie) {
            return response()->json([
                'message' => 'Cette catégorie existe déjà'
            ], Response::HTTP_CONFLICT);
        }
        Categorie::create([
            'libelle' => $categorieName
        ]);
    
        return response()->json([
            'message' => 'Catégorie créée avec succès'
        ], Response::HTTP_CREATED);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $libelle)
    {
        $categorie = Categorie::where('libelle', $libelle)->first();
        if (!$categorie) {
            return response()->json([
                'message' => 'Categorie non trouvée'
            ], Response::HTTP_NOT_FOUND);
        }
        return response()->json($categorie, Response::HTTP_OK);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriePostRequest $request, string $id)
    {
        $categorie = Categorie::where('id', $id)->first();
        if (!$categorie) {
            return response()->json([
                'message' => 'Categorie non trouvée'
            ], Response::HTTP_NOT_FOUND);
        }
        $categorie->update([
            'libelle' => $request->input('libelle')
        ]);
        return response()->json([
            'message' => 'Categorie modifiée avec succès'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $ids = request()->input('ids');
        if (empty($ids)) {
            return response()->json([
                'message' => 'Aucun ID fourni pour la suppression'
            ], Response::HTTP_BAD_REQUEST);
        }
    
        foreach ($ids as $id) {
            $categorie = Categorie::where('id', $id)->withTrashed()->first();
    
            if (!$categorie) {
                return response()->json([
                    'message' => 'Categorie non trouvée pour l\'ID ' . $id
                ], Response::HTTP_NOT_FOUND);
            }
    
            $categorie->delete();
        }
    
        return response()->json([
            'message' => 'Catégories supprimées avec succès'
        ], Response::HTTP_OK);
    }
    
}
