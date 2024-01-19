<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EtudiantController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $etudiant = Etudiant::where('user_id',$user->id);
        if ($etudiant->exists()) {
            return redirect()->route('etudiants.show', $etudiant->first()->id);            
        }
      
        $data = Etudiant::with('filiere')->get();
        return view('etudiants.index', compact('data'));
    }
    public function create(){
    
        $user = Auth::user();
        $etudiant = Etudiant::where('user_id',$user->id);
        if (!$etudiant->exists()) {
            return redirect()->route('etudiants.show', $etudiant->first()->id);            
        }
        $filieres = Filiere::all();
        return view('etudiants.form', compact('filieres'));
    }
    
    public function store(Request $request){
        // Create or update the associated user
        $user = User::updateOrCreate(
            ['email' => $request->input('user.email')],
            [
                'name' => $request->input('user.name'),
                'password' => Hash::make($request->input('user.password')),
            ]
        );
    
        // Create the student and associate the user
        $etudiant = Etudiant::create([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'sexe' => $request->input('sexe'),
            'filiere_id' => $request->input('filiere_id'),
            'user_id' => $user->id,
        ]);
    
        return redirect()->route('etudiants.index');
    }    
    public function update(Request $request, $id){
        // Find the student
        $etudiant = Etudiant::findOrFail($id);
    
        // Update the student
        $etudiant->update($request->except('user'));
    
        // Create or update the associated user
        $user = User::updateOrCreate(
            ['email' => $request->input('user.email')],
            [
                'name' => $request->input('user.name'),
                'password' => Hash::make($request->input('user.password')),
               
            ]
        );
    
        // Associate the user with the student
        $etudiant->user()->associate($user);
        $etudiant->save();
    
        return redirect()->route('etudiants.index');
    }  
    public function show($id)
    {
        $etudiant = Etudiant::find($id);
        return view('etudiants.show', compact('etudiant'));

    }
    public function edit($id){
        $etudiant = Etudiant::findOrFail($id);
        $filieres = Filiere::all();
        return view('etudiants.form', compact('etudiant', 'filieres'));
    }      
    public function destroy($id){
        Etudiant::destroy($id);
        return redirect()->route('etudiants.index');
    }
    
}
