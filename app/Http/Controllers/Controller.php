<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $user = Auth::user();
        if($user)
        {
            $etudiant = Etudiant::where('user_id',$user->id);
            if ($etudiant->exists()) {
                return redirect()->route('etudiants.show', $etudiant->first()->id);            
            }
            return view('index');
        }else
        {
            return view('index');
        }
       
       
    }
    public function registerindex()
    {
        $filieres = Filiere::all();
        return view('register', compact('filieres'));
    }
    public function register(Request $request){
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
    
        return redirect()->route('login')->with('success', 'Student created successfully');
    }
}
