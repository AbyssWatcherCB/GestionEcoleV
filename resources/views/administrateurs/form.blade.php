<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulaire Administrateur</title>
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
    <h1>Formulaire Administrateur</h1>

    @if(isset($administrateur))
        <form action="{{ route('administrateurs.update', $administrateur->id) }}" method="POST">
            @method('PUT')
            <input type="hidden" name="id" value="{{ $administrateur->id }}">
    @else
        <form action="{{ route('administrateurs.store') }}" method="POST">
    @endif
            @csrf

            <!-- Administrateur fields -->
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="{{ isset($administrateur) ? $administrateur->nom : '' }}"><br>

            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" value="{{ isset($administrateur) ? $administrateur->prenom : '' }}"><br>

            <label for="sexe">Sexe:</label>
            <select id="sexe" name="sexe">
                <option value="homme" {{ isset($administrateur) && $administrateur->sexe === 'homme' ? 'selected' : '' }}>Homme</option>
                <option value="femme" {{ isset($administrateur) && $administrateur->sexe === 'femme' ? 'selected' : '' }}>Femme</option>
            </select><br>

            <label for="user[name]">User Name:</label>
            <input type="text" id="user[name]" name="user[name]" value="{{ isset($administrateur->user) ? $administrateur->user->name : '' }}" placeholder="User Name"><br>
            <label for="user[email]">User Email:</label>
            <input type="email" id="user[email]" name="user[email]" value="{{ isset($administrateur->user) ? $administrateur->user->email : '' }}" placeholder="User Email"><br>
            <label for="user[password]">User Password:</label>
            <input type="password" id="user[password]" name="user[password]" placeholder="User Password"><br>

            <input type="submit" value="{{ isset($administrateur) ? 'Mettre à jour' : 'Ajouter' }}">
        </form>

    <a href="{{ route('administrateurs.index') }}">Retour à la liste des Administrateurs</a>
</body>
</html>
