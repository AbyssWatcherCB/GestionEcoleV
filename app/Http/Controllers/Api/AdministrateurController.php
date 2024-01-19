<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Administrateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdministrateurController extends Controller
{
    public function index()
    {
        $administrateurs = Administrateur::all();
        return response()->json($administrateurs);
    }

    public function show($id)
    {
        $administrateur = Administrateur::find($id);

        if (!$administrateur) {
            return response()->json(['message' => 'Administrateur not found'], 404);
        }

        return response()->json($administrateur);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required|in:homme,femme',
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

        $administrateur = Administrateur::create([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'sexe' => $request->input('sexe'),
            'user_id' => $user->id,
        ]);

        return response()->json($administrateur, 201);
    }

    public function update(Request $request, $id)
    {
        $administrateur = Administrateur::find($id);

        if (!$administrateur) {
            return response()->json(['message' => 'Administrateur not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nom' => 'sometimes|required',
            'prenom' => 'sometimes|required',
            'sexe' => 'sometimes|required|in:homme,femme',
            'user.email' => 'sometimes|required|email|unique:users,email,' . $administrateur->user_id,
            'user.name' => 'sometimes|required',
            'user.password' => 'sometimes|required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = User::find($administrateur->user_id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update([
            'email' => $request->input('user.email'),
            'name' => $request->input('user.name'),
            'password' => Hash::make($request->input('user.password')),
        ]);

        $administrateur->update($request->only(['nom', 'prenom', 'sexe']));

        return response()->json($administrateur);
    }

    public function destroy($id)
    {
        $administrateur = Administrateur::find($id);

        if (!$administrateur) {
            return response()->json(['message' => 'Administrateur not found'], 404);
        }

        $administrateur->delete();

        return response()->json(['message' => 'Administrateur deleted']);
    }
}
