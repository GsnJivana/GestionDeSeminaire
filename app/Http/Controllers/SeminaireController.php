<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seminaire;
use App\Models\User;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SeminaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // On récupère tous les enseignants sauf l'utilisateur actuel pour la liste des co-présentateurs
        $enseignants = User::where('role', 'enseignant')->where('id', '!=', Auth::id())->get();
        return view('seminaires.create', compact('enseignants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'theme' => 'required|string|max:255',
            'description' => 'required|string',
            'co_presentateurs' => 'nullable|array',
            'co_presentateurs.*' => 'exists:users,id', 
        ]);

        $seminaire = Seminaire::create([
            'presentateur_id' => Auth::id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . uniqid(),
            'theme' => $request->theme,
            'description' => $request->description,
           
        ]);

       
        if ($request->has('co_presentateurs')) {
            $seminaire->copresentateur()->attach($request->co_presentateurs);
        }

        return redirect()->route('dashboard')->with('success', 'Votre proposition de séminaire a été soumise avec succès.');
    }

    /**
     * Display the specified resource.
     */
     // Affiche la liste des séminaires validés
    public function index()
    {
        $seminaires = Seminaire::where('statut', 'valider')
                                ->with('presentateur')
                                ->orderBy('date_de_presentation', 'desc')
                                ->paginate(10);
        return view('seminaires.index', compact('seminaires'));
    }

    // Affiche les détails d'un séminaire
    public function show(Seminaire $seminaire)
    {
        
        if ($seminaire->statut !== 'valider' && (Auth::guest() || Auth::user()->role === 'etudiant')) {
             abort(404);
        }
        
        $seminaire->load('presentateur', 'copresentateur');
        return view('seminaires.show', compact('seminaire'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
