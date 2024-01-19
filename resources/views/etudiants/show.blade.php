@extends('Layout.Layout')

@section('title', 'Détails de Étudiant')

@section('content')

<h1 style="color: gold">Détails de l'Étudiant</h1>
<p ><strong style="color: rgb(233, 104, 45)">Nom:</strong> {{ $etudiant->nom }}</p>
<p><strong style="color: rgb(233, 104, 45)">Prénom:</strong> {{ $etudiant->prenom }}</p>
<p><strong style="color: rgb(233, 104, 45)">Sexe:</strong> {{ $etudiant->sexe }}</p>
<p><strong style="color: rgb(233, 104, 45)">Filière:</strong> {{ $etudiant->filiere->nom }}</p>

<a href="{{ route('etudiants.edit', $etudiant->id) }}">Modifier</a>
<a href="{{ route('etudiants.destroy', $etudiant->id) }}">Supprimer</a>
@endsection
