<!DOCTYPE html>
<!-- Designined by CodingLab - youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Registration Form | CodingLab </title>
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
        <form action="{{route('registerstore')}}" method="POST">
            @csrf
            <div class="user-details">
                <div class="input-box">
                    <label for="nom">Nom:</label>
                    <input type="text" id="nom" name="nom" value="{{ isset($etudiant) ? $etudiant->nom : '' }}" required>
                </div>
                <div class="input-box">
                    <label for="prenom">Prénom:</label>
                    <input type="text" id="prenom" name="prenom" value="{{ isset($etudiant) ? $etudiant->prenom : '' }}" required>
                </div>
                <div class="input-box">
                    <label for="sexe">Sexe:</label>
                    <select id="sexe" name="sexe" required>
                        <option value="homme" {{ isset($etudiant) && $etudiant->sexe === 'homme' ? 'selected' : '' }}>Homme</option>
                        <option value="femme" {{ isset($etudiant) && $etudiant->sexe === 'femme' ? 'selected' : '' }}>Femme</option>
                    </select>
                </div>
                <div class="input-box">
                    <label for="filiere_id">Filière:</label>
                    <select name="filiere_id" id="filiere_id" required>
                        @foreach($filieres as $filiere)
                            <option value="{{ $filiere->id }}" @if(isset($etudiant) && $etudiant->filiere_id == $filiere->id) selected @endif>{{ $filiere->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-box">
                    <label for="user[name]">User Name:</label>
                    <input type="text" id="user[name]" name="user[name]" value="{{ isset($etudiant->user) ? $etudiant->user->name : '' }}" placeholder="User Name" required>
                </div>
                <div class="input-box">
                    <label for="user[email]">User Email:</label>
                    <input type="email" id="user[email]" name="user[email]" value="{{ isset($etudiant->user) ? $etudiant->user->email : '' }}" placeholder="User Email" required>
                </div>
                <div class="input-box">
                    <label for="user[password]">User Password:</label>
                    <input type="password" id="user[password]" name="user[password]" placeholder="User Password" required>
                </div>
            </div>
            <div class="button">
                <input type="submit" value="Register">
            </div>
        </form>
        
    </div>
  </div>

</body>
</html>
