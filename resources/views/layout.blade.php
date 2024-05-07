<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--    <link rel="stylesheet"  href="{{ asset('/style.css') }}">  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('jquery-3.7.1.js')}}"></script><style>* {margin: 0;padding: 0;font-family: sans-serif;}</style>
  <title>Recipe Book</title>
  @yield('content_head')
  
</head>

<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark" >
    <div class="container-fluid">
      <a class="navbar-brand" href="/home">HOME</a>

      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="/Recipes">Recipes</a>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Ingredients</a>
          <ul class="dropdown-menu">
           @foreach($rec as $c)
           <a class="dropdown-item" href="/Ing/{{$c->id}}">{{$c->RecipeName}}</a><!-- CATEGORY CARD  -->
          @endforeach
            </ul>
            </li>  
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            @if(session('user'))
            <li class="nav-item">
               <h3  class="nav-link">Hello, {{ session('user')->full_name }} <a href="/logout"  style="color:red;">Logout?</a></h3>
            @else
                <h3  class="nav-link">Guest User ,<a href="/log"  style="color:crimson;">Login?</a></h3>   
            @endif
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <!--
<div class="collapse" id="navbarToggleExternalContent">
  <div class="bg-dark p-4">

            @if(session('user'))
               <h3 style="color:wheat">Welcome, {{ session('user')->full_name }}!</h3>
            @else
                <h3 align='right'>Guest User ,<a href="/log"  style="color:crimson;">Login?</a></h3>   
            @endif
  </div>
</div>
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>  -->
  <div>
    @yield('content_body')
  </div>


  <!--
<div class="foot">
        <p>&copy; {{ date('d-m-Y') }} Your Recipe Book. All rights reserved.</p>
</div>  -->
</body>

</html>