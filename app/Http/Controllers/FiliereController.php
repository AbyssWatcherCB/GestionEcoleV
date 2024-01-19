<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\User;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    public function index(){
        $filieres = Filiere::all();
        return view('filieres.index', compact('filieres'));
    }
    public function create(){
        return view('filieres.form');
    }
    public function store(Request $request){
       Filiere::create($request->all());
       return redirect()->route('filiere.index');
    }
    public function show($id)
    {
        $filieres = Filiere::find($id);
        $data = Etudiant::select('*')->where('filiere_id', $id)->get();
        return view('filieres.show', compact('filieres', 'data'));

    }
    public function edit($id){
        $filiere = Filiere::find($id);
        return view('filieres.form', compact('filiere'));
    }
    
    public function update(Request $request){
        $filiere = Filiere::find($request->id);
        $filiere->update($request->all());
        return redirect()->route('filiere.index');
    }
    
    public function destroy($id)
    {
        // Find the Filiere by its ID
        $filiere = Filiere::findOrFail($id);
    
        // Get all associated Etudiants
        $etudiants = $filiere->etudiants;
    
        // Get the user IDs of all associated Etudiants
        $userIds = $etudiants->pluck('user_id')->toArray();
    
        // Delete the Etudiants
        Etudiant::whereIn('user_id', $userIds)->delete();
    
        // Delete the associated Users
        User::whereIn('id', $userIds)->delete();
    
        // Finally, delete the Filiere
        $filiere->delete();
    
        return redirect()->route('filiere.index');
    }
}
