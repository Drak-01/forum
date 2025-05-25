<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    function index() {
        return view('auth.forms.register');
    }

    function store(Request $request) {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'univEmail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'lastName' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'userPicture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gérer l'upload de l'image si elle existe
        $picturePath = null;
        if ($request->hasFile('userPicture')) {
            $picturePath = $request->file('userPicture')->store('profile_pictures', 'public');
        }

        // Créer un nouvel utilisateur
        $user = new User();
        $user->username = $validatedData['username'];
        $user->univEmail = $validatedData['univEmail'];

        $user->password = Hash::make($validatedData['password']);
        
        $user->lastName = $validatedData['lastName'];
        $user->firstName = $validatedData['firstName'];
        $user->userPicture = $picturePath; // nullable donc pas besoin de vérifier
        
        $user->save();

        // Connecter l'utilisateur directement après l'inscription
        Auth::login($user);


        // Rediriger vers la page d'accueil avec un message de succès
        return redirect()->route('questions.index')->with('success', 'Inscription réussie ! Vous êtes maintenant connecté.');
    }

    
   
}
