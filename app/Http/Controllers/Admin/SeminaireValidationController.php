<?php

namespace App\Http\Controllers\Admin;
use App\Models\Seminaire;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SeminaireProgrammer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeminaireValidationController extends Controller
{
    //
     public function index()
    {
        $seminairesEnAttente = Seminaire::where('statut', 'non_valider')->with('presentateur')->latest()->get();
        return view('admin.seminaires.validation', compact('seminairesEnAttente'));
    }

    public function valider(Request $request, Seminaire $seminaire)
    {
        $request->validate([
            'date_de_presentation' => 'required|date|after:today',
        ]);

        $seminaire->update([
            'statut' => 'valider',
            'date_de_presentation' => $request->date_de_presentation,
        ]);
        
        // Envoi de la notification à tous les utilisateurs
        $users = User::all();
        Notification::send($users, new SeminaireProgrammer($seminaire));

        return redirect()->route('admin.seminaires.validation')->with('success', 'Séminaire validé et programmé ! Un email a été envoyé à tous les utilisateurs.');
    }
}
