@php
  use App\Models\Etudiant;
@endphp

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>@yield('title', 'Page Accueil')</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('accueil/css/bootstrap.css') }}" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <link href="{{ asset('accueil/css/style.css') }}" rel="stylesheet" />
  <link href="{{ asset('accueil/css/responsive.css') }}" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
  
  
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
        <div class="container-fluid ">
          <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="">
              <img src="accueil/images/logo.png" alt="" />
              <span>
                Gestion d'ecole
              </span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
      
            <div class="collapse navbar-collapse" >
              <ul class="navbar-nav">
                @auth
                @if (Etudiant::where('user_id',Auth::user()->id)->exists()) 
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('etudiants.show',Etudiant::where('user_id',Auth::user()->id)->first()->id)}}">Profile</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('filiere.index')}}">List Filieres</a>
                </li>           
                @else
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('etudiants.index')}}">List Etudiants</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('filiere.index')}}">List Filieres</a>
                </li>
              
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('administrateurs.index')}}">List administrateurs</a>
                </li>
                @endif
                
                @endauth
                
              </ul>     
            </div>
            <div class="user_option">
                @auth
                  <p class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">Bonjour, {{ Auth::user()->name }}</p>
                  <br>
                  <a class="nav-link" href="{{ route('logout')}}">Deconnect</a>
                @else
                  <a href="{{ route('login') }}">
                    <span>Login</span>
                  </a>
                  <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0" action="{{ route('login') }}">
                    <button class="btn  my-2 my-sm-0 nav_login-btn" type="submit"></button>
                  </form>
                @endauth
              </div>
          </nav>
        </div>
      </header>
      <section class="slider_section">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-5 offset-md-1">
                  <div class="detail-box">
                    @yield('content')
                  </div>
                </div>
                <div class="offset-md-1 col-md-4 img-container">
                  <div class="img-box">
                    <img src="{{asset('accueil/images/img.png')}}" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      
  </div>


 

   
  <script src="{{asset('accueil/js/jquery-3.4.1.min.js')}}"></script>
  <script src="{{asset('accueil/js/bootstrap.js')}}"></script>
  <script src="{{asset('accueil/js/custom.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="{{asset('index/js/scripts.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
  <script src="{{asset('index/js/datatables-simple-demo.js')}}"></script>

</body>

</body>
</html>