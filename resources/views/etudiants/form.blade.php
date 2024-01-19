<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulaire Étudiant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    @auth
    <p>Welcome, {{ Auth::user()->name }}</p>
    @endauth
    <p> <a href="{{ route('logout') }}">Logout</a> </p>
    <h1>Formulaire Étudiant</h1>

    @if(isset($etudiant))
        <form action="{{ route('etudiants.update', $etudiant->id) }}" method="POST">
            @method('PUT')
            <input type="hidden" name="id" value="{{ $etudiant->id }}">
    @else
        <form action="{{ route('etudiants.store') }}" method="POST">
    @endif
            @csrf

            <!-- Etudiant fields -->
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="{{ isset($etudiant) ? $etudiant->nom : '' }}"><br>

            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" value="{{ isset($etudiant) ? $etudiant->prenom : '' }}"><br>

            <label for="sexe">Sexe:</label>
            <select id="sexe" name="sexe">
                <option value="homme" {{ isset($etudiant) && $etudiant->sexe === 'homme' ? 'selected' : '' }}>Homme</option>
                <option value="femme" {{ isset($etudiant) && $etudiant->sexe === 'femme' ? 'selected' : '' }}>Femme</option>
            </select><br>

            <label for="filiere_id">Filière:</label>
            <select name="filiere_id" id="filiere_id">
                @foreach($filieres as $filiere)
                    <option value="{{ $filiere->id }}" @if(isset($etudiant) && $etudiant->filiere_id == $filiere->id) selected @endif>{{ $filiere->nom }}</option>
                @endforeach
            </select><br>

            <label for="user[name]">User Name:</label>
            <input type="text" id="user[name]" name="user[name]" value="{{ isset($etudiant->user) ? $etudiant->user->name : '' }}" placeholder="User Name"><br>
            <label for="user[email]">User Email:</label>
            <input type="email" id="user[email]" name="user[email]" value="{{ isset($etudiant->user) ? $etudiant->user->email : '' }}" placeholder="User Email"><br>
            <label for="user[password]">User Password:</label>
            <input type="password" id="user[password]" name="user[password]" placeholder="User Password"><br>

            <input type="submit" value="{{ isset($etudiant) ? 'Mettre à jour' : 'Ajouter' }}">
        </form>

    <a href="{{ route('etudiants.index') }}">Retour à la liste des Étudiants</a>
</body>
</html>
