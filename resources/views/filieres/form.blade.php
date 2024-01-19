<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulaire de Filière</title>
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
    <h1>Formulaire de Filière</h1>

    @if(isset($filiere))
        <form action="{{ route('filiere.update', $filiere->id) }}" method="POST">
            @method('PUT')
            <input type="hidden" name="id" value="{{ $filiere->id }}">
    @else
        <form action="{{ route('filiere.store') }}" method="POST">
    @endif
            @csrf
            <label for="nom">Nom de la Filière:</label>
            <input type="text" id="nom" name="nom" value="{{ isset($filiere) ? $filiere->nom : '' }}"><br>

            <input type="submit" value="{{ isset($filiere) ? 'Mettre à jour' : 'Ajouter' }}">
        </form>

    <a href="{{ route('filiere.index') }}">Retour à la liste des Filières</a>
</body>
</html>
