<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Administrateur;
use App\Models\Etudiant;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();  
            $admin=  Administrateur::where('user_id', $user->id)->first();     
            if ($admin) {
                return redirect()->route('index');
            }
            else
            {
                $etudiants= Etudiant::where('user_id', $user->id)->first();
                return redirect()->route('etudiants.show', $etudiants->id);
            }
        }
    
        // Authentication failed
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ])->save();
        Auth::login($user);
        return redirect()->route('index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
