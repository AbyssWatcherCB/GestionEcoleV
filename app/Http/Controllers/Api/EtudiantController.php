<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Filiere;
use App\Models\User;

class EtudiantController extends Controller
{
    public function index()
    {
        $etudiants = Etudiant::with('filiere')->get();
        return response()->json($etudiants);
    }

    public function show($id)
    {
        $etudiant = Etudiant::with('filiere')->find($id);

        if (!$etudiant) {
            return response()->json(['message' => 'Etudiant not found'], 404);
        }

        return response()->json($etudiant);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required|in:homme,femme',
            'filiere_id' => 'required|exists:filieres,id',
            'user.email' => 'required|email|unique:users,email',
            'user.name' => 'required',
            'user.password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = User::create([
            'email' => $request->input('user.email'),
            'name' => $request->input('user.name'),
            'password' => Hash::make($request->input('user.password')),
        ]);

        $etudiant = Etudiant::create([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'sexe' => $request->input('sexe'),
            'filiere_id' => $request->input('filiere_id'),
            'user_id' => $user->id,
        ]);

        return response()->json($etudiant, 201);
    }

    public function update(Request $request, $id)
    {
        $etudiant = Etudiant::find($id);
    
        if (!$etudiant) {
            return response()->json(['message' => 'Etudiant not found'], 404);
        }
    
        $validator = Validator::make($request->all(), [
            'nom' => 'sometimes|required',
            'prenom' => 'sometimes|required',
            'sexe' => 'sometimes|required|in:homme,femme',
            'filiere_id' => 'sometimes|required|exists:filieres,id',
            'user.email' => 'sometimes|required|email|unique:users,email,' . $etudiant->user_id,
            'user.name' => 'sometimes|required',
            'user.password' => 'sometimes|required|min:6',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        $user = User::find($etudiant->user_id);
    
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        $user->update([
            'email' => $request->input('user.email'),
            'name' => $request->input('user.name'),
            'password' => Hash::make($request->input('user.password')),
        ]);
    
        $etudiant->update($request->only(['nom', 'prenom', 'sexe', 'filiere_id']));
    
        return response()->json($etudiant);
    }
    

    public function destroy($id)
    {
        $etudiant = Etudiant::find($id);

        if (!$etudiant) {
            return response()->json(['message' => 'Etudiant not found'], 404);
        }

        $etudiant->delete();

        return response()->json(['message' => 'Etudiant deleted']);
    }
}
