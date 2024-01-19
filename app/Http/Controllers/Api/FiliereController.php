<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Filiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FiliereController extends Controller
{
    public function index()
    {
        $filieres = Filiere::all();
        return response()->json($filieres);
    }

    public function create()
    {
        // Implement logic for creating a new Filiere (if required)
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $filiere = Filiere::create($request->all());

        return response()->json($filiere, 201);
    }

    public function show($id)
    {
        $filiere = Filiere::find($id);

        if (!$filiere) {
            return response()->json(['message' => 'Filiere not found'], 404);
        }

        return response()->json($filiere);
    }

    public function update(Request $request, $id)
    {
        $filiere = Filiere::find($id);

        if (!$filiere) {
            return response()->json(['message' => 'Filiere not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nom' => 'sometimes|required',
           
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $filiere->update($request->all());

        return response()->json($filiere);
    }

    public function destroy($id)
    {
        $filiere = Filiere::find($id);

        if (!$filiere) {
            return response()->json(['message' => 'Filiere not found'], 404);
        }

        $filiere->delete();

        return response()->json(['message' => 'Filiere deleted successfully']);
    }
}
