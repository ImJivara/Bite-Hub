<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>Your Website</title>
  <style>
    /* Custom Styles */
    body {
      padding-top: 56px; /* Adjusted for fixed navbar height */
    }

    .navbar {
      background-color: #100C08 !important;
    }

    .navbar-brand,
    .navbar-nav .nav-link {
      color: #fff; /* Navbar text color */
    }
    

    .navbar-brand:hover,
    .navbar-nav .nav-link:hover {
      color: #ffc107; /* Navbar text color on hover */
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">Your Logo/Brand</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="/home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/Recipes">Recipes</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">Ingredients</a>
          <ul class="dropdown-menu">
           
          </ul>
        </li> 
        
          <li class="nav-item">
            @if(session('user'))
            <li class="nav-item">
            <a class="nav-link" href="#">Hello</a>
               <h6  class="nav-link">Hello, {{ session('user')->full_name }}<a href="/logout"  style="color:crimson;">Logout?</a></h6>
            @else
                <h6  class="nav-link">Guest User, <a href="/log"  style="color:crimson;">Login?</a></h6>   
            @endif
          </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Your content goes here -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
