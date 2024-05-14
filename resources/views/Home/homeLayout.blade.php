<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Food Blog</title>
    <link rel="stylesheet"  href="{{ asset('/homelayout.css') }}"> 
</head>
<body>
    <header>
        <center><h1>Your Food Blog</h1></center>
    </header>
    <nav>
        <ul id="nav">
            <li class="nav-link">
                <a href="/Login">
                    <h1 data-name="Login">Login</h1>
                </a>
            </li>
            <li class="nav-link">
                <a href="/Services">
                    <h1 data-name="Services">Services</h1>
                </a>
            </li>
            <li class="nav-link">
                <a href="/Contact">
                    <h1 data-name="Contact">Contact</h1>
                </a>
            </li>
        </ul>
    </nav>
	@yield("content_body")  
    <footer>
        <p>&copy; 2024 Your Food Blog. All rights reserved.</p>
    </footer>

</body>

</html>
