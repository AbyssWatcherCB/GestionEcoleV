
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

  <title>Page Accueil</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="accueil/css/bootstrap.css" />

  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="accueil/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="accueil/css/responsive.css" rel="stylesheet" />
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
        <div class="container-fluid ">
          <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="{{ route('index')}}">
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
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('etudiants.index')}}">List Etudiants</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('filiere.index')}}">List Filieres</a>
                </li>
              
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('administrateurs.index')}}">List administrateurs</a>
                </li>
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
                  &ensp;&ensp;
                  <a href="{{ route('registerindex') }}">
                    <span>S'inscrire</span>
                  </a>
                @endauth
              </div>
          </nav>
        </div>
      </header>
      
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section ">
      <div class="carousel_btn-container">
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="sr-only">Next</span>
        </a>
      </div>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">01</li>
          @auth
          <li data-target="#carouselExampleIndicators" data-slide-to="1">02</li>     
          <li data-target="#carouselExampleIndicators" data-slide-to="2">03</li>
          @endauth
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-5 offset-md-1">
                  <div class="detail-box">
                    <h1>
                      Explorez Nos <br>
                      Filières <br>
                      Ici
                    </h1>
                    <p>
                      Découvrez notre large gamme de cours et de programmes conçus pour répondre à vos objectifs éducatifs.
                    </p>
                    <div class="btn-box">
                      <a href="{{ route('filiere.index') }}" class="btn-1">
                        Explorer les Filières
                      </a>
                    </div>
                  </div>
                </div>
                <div class="offset-md-1 col-md-4 img-container">
                  <div class="img-box">
                    <img src="accueil/images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          @auth  
          <div class="carousel-item">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-5 offset-md-1">
                  <div class="detail-box">
                    <h1>
                      Rencontrez Nos <br>
                      Étudiants <br>
                      Ici
                    </h1>
                    <p>
                      Familiarisez-vous avec nos étudiants talentueux et leur parcours éducatif avec nous.
                    </p>
                    <div class="btn-box">
                      <a href="{{ route('etudiants.index') }}" class="btn-1">
                        Rencontrer les Étudiants
                      </a>
                    </div>
                  </div>
                </div>
                <div class="offset-md-1 col-md-4 img-container">
                  <div class="img-box">
                    <img src="accueil/images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        
          <div class="carousel-item">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-md-5 offset-md-1">
                          <div class="detail-box">
                              <h1>
                                  Découvrez Nos <br>
                                  Administrateurs <br>
                                  Ici
                              </h1>
                              <p>
                                  Familiarisez-vous avec nos administrateurs talentueux et leur parcours professionnel avec nous.
                              </p>
                              <div class="btn-box">
                                  <a href="{{ route('administrateurs.index') }}" class="btn-1">
                                      Découvrir les Administrateurs
                                  </a>
                              </div>
                          </div>
                      </div>
                      <div class="offset-md-1 col-md-4 img-container">
                          <div class="img-box">
                              <img src="accueil/images/slider-img.png" alt="">
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      @endauth
      
        
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>


  <script src="accueil/js/jquery-3.4.1.min.js"></script>
  <script src="accueil/js/bootstrap.js"></script>
  <script src="accueil/js/custom.js"></script>


</body>

</body>
</html>