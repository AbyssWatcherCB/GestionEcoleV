<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrateur;
use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdministrateurController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $etudiant = Etudiant::where('user_id',$user->id);
        if ($etudiant->exists()) {
            return redirect()->route('etudiants.show', $etudiant->first()->id);            
        }
        $administrateurs = Administrateur::all();
        return view('administrateurs.index', compact('administrateurs'));
    }
    

    public function create()
    {
        $user = Auth::user();
        $etudiant = Etudiant::where('user_id',$user->id);
        if ($etudiant->exists()) {
            return redirect()->route('etudiants.show', $etudiant->first()->id);            
        }
        return view('administrateurs.form');
    }

    public function store(Request $request)
    {
        // Create or update the associated user
        $user = User::updateOrCreate(
            ['email' => $request->input('user.email')],
            [
                'name' => $request->input('user.name'),
                'password' => Hash::make($request->input('user.password')),
            ]
        );

        // Create the administrator and associate the user
        $administrateur = Administrateur::create([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'sexe' => $request->input('sexe'),
            'user_id' => $user->id,
        ]);

        return redirect()->route('administrateurs.index');
    }

    public function update(Request $request, $id)
    {
        // Find the administrator
        $administrateur = Administrateur::findOrFail($id);

        // Update the administrator
        $administrateur->update($request->except('user'));

        // Create or update the associated user
        $user = User::updateOrCreate(
            ['email' => $request->input('user.email')],
            [
                'name' => $request->input('user.name'),
                'password' => Hash::make($request->input('user.password')),
            ]
        );

        // Associate the user with the administrator
        $administrateur->user()->associate($user);
        $administrateur->save();

        return redirect()->route('administrateurs.index');
    }

    public function show($id)
    {
        $user = Auth::user();
        $etudiant = Etudiant::where('user_id',$user->id);
        if ($etudiant->exists()) {
            return redirect()->route('etudiants.show', $etudiant->first()->id);            
        }
        $administrateur = Administrateur::find($id);
        return view('administrateurs.show', compact('administrateur'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        $etudiant = Etudiant::where('user_id',$user->id);
        if ($etudiant->exists()) {
            return redirect()->route('etudiants.show', $etudiant->first()->id);            
        }
        $administrateur = Administrateur::findOrFail($id);
        return view('administrateurs.form', compact('administrateur'));
    }

    public function destroy($id)
    {
        Administrateur::destroy($id);
        return redirect()->route('administrateurs.index');
    }
}
