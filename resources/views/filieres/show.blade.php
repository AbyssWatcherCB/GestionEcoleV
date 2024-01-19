@php
  use App\Models\Etudiant;
@endphp


@extends('Layout.Layout')

@section('title', 'Détails de la Filière')

@section('content')

<h1 style="color: gold">Détails de la Filière</h1>
<p ><strong style="color: rgb(233, 104, 45)">Nom:</strong>  {{ $filieres->nom }}</p>
@auth
@if (!Etudiant::where('user_id',Auth::user()->id)->exists()) 
<a href="{{ route('filiere.edit', $filieres->id) }}">Modifier</a>
<a href="{{ route('filiere.destroy', $filieres->id) }}">Supprimer</a>
@endif
@endauth

<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4"  style="color: gold">List Etudiants</h1>
                <div class="card mb-4">
                    @auth
                    @if (!Etudiant::where('user_id',Auth::user()->id)->exists()) 
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        <a href="{{ route('etudiants.create') }}">Ajouter un étudiant</a>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $etudiant)
                                <tr>
                                    <td>{{ $etudiant->nom }} {{ $etudiant->prenom }}</td>
                                    <td>
                                        <a href="{{ route('etudiants.show', $etudiant->id) }}">Details</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                       
                     
                    </div>
                    @else
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $etudiant)
                                <tr>
                                    <td>{{ $etudiant->nom }} {{ $etudiant->prenom }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>                     
                    </div>
                    @endif
                    @endauth
                  
                </div>
            </div>
        </main>
    </div>
</div>
@endsection


