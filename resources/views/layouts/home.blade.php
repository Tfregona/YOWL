<?php
      // On recupere l'URL de la page pour ensuite affecter class = "active" aux liens de nav
      $page = $_SERVER['REQUEST_URI'];
      $page = str_replace("localhost:8000", "",$page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Yowl®</title>

    <!-- icon -->
    <link rel="icon" type="image/x-icon" href="{{ url('favicon.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS BT -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- JS BT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/0eda521942.js" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="../../css/app.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rasa:wght@300;500;600;700&display=swap" rel="stylesheet">
  </head>

<body class="antialiased">

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4a919e;">
        <div class="container-fluid">
            <a class="navbar-brand active" aria-current="page" href="/">Yowl®</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="true" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse show" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" <?php if($page=="categoriesall.blade.php" ){echo 'class="active"'
              ;}else{echo 'class="nav-link"' ;} ?> href="{{route('categories')}}">Categories</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @forelse ($categories as $item)
                            <li><a class="dropdown-item" href="{{route('subcategories', $item->id)}}">
                                    {{ $item->title }}</a>
                                @empty
                                <p>
                                    Empty
                                </p>
                                @endforelse
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{route('categories')}}">Toutes les categories</a></li>
                        </ul>
                    </li>
                    @if(Auth::guest())
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="">Créer un post</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('post.landing')}}">Créer un post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.profile')}}">
                            Mon profil : {{ Auth::user()->nickname }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('logout')}}">Déconnexion</a>
                    </li>
                    @endif
                </ul>
                <!-- <form class="d-flex">
                    <input class="form-control me-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form> -->
                @if(!empty(Auth::user()->avatar->filename))
                <a href="{{route('user.profile')}}">
                    <img src="{{asset(Auth::user()->avatar->thumb_url)}}" height="50" class="rounded-circle"
                        alt="Photo de profil" id="photo-nav"></a>
                @endif
            </div>
        </div>
    </nav>

    <div id="app">
        <!-- <router-view /> -->
    </div>
    @yield('content')

    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-chevron-up"></i></button>

    <!-- Footer -->
    <footer class="d-flex flex-column">
        <div class="container py-5">
            <div class="row py-4">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0"><img src="{{ url('favicon.png') }}" alt="Logo Yowl"
                        width="80" class="mb-3">
                    <p class="font-italic text-light">Yowl, votre site de commentaires culturels !</p>
                    <ul class="list-inline mt-4">
                        <li class="list-inline-item"><a id="footer-rs" href="#" target="_blank" title="twitter"><i
                                    class="fa fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item"><a id="footer-rs" href="#" target="_blank" title="facebook"><i
                                    class="fa fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item"><a id="footer-rs" href="#" target="_blank" title="instagram"><i
                                    class="fa fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a id="footer-rs" href="#" target="_blank" title="pinterest"><i
                                    class="fa fa-pinterest"></i></a></li>
                        <li class="list-inline-item"><a id="footer-rs" href="#" target="_blank" title="vimeo"><i
                                    class="fa fa-vimeo"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-white font-weight-bold mb-4">SITE MAP</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="{{route('categories')}}" class="link-light">Categories</a></li>
                        <li class="mb-2"><a href="{{route('mentionslegales')}}" class="link-light">Mentions légales</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-white font-weight-bold mb-4">CONTACT</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="mailto:contact@yowl.com" class="link-light">Email</a></li>
                        <li class="mb-2">
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 mb-lg-0">
                    <h6 class="text-white font-weight-bold mb-4">NEWSLETTER</h6>
                    <p class="text-light mb-4">Inscrivez-vous à notre newsletter pour recevoir les offres de nos partenaires :</p>
                    <button  class="btn btn-secondary my-2 my-sm-0" > <a  class="nav-link" href="{{route('newsletter')}} "style="text-decoration:none ; color:white">S'inscrire à la newsletter</a></button>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Copyrights -->
        <div id="rights-footer" class="bg-light py-4">
            <div class="container text-center">
                <p class="text-light mb-0 py-2">© 2021 Yowl® All rights reserved</p>
            </div>
        </div>
    </footer>
    <!-- End -->

    <script src="{{ asset('js/app.js')}}"></script>
    <script>
    var mybutton = document.getElementById("myBtn");
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
    </script>
</body>

</html>