<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Food Blog</title>
   <!-- <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> -->
   <style> 
   /* Reset and Global Styles */
/* Reset and Global Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f8f8;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Header Styles */
.header {
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.logo h1 {
    font-size: 24px;
    color: #333;
    margin-bottom: 5px;
}

.logo p {
    font-size: 14px;
    color: #666;
}

.navigation ul {
    list-style: none;
}

.navigation ul li {
    display: inline-block;
    margin-left: 20px;
}

.navigation ul li:first-child {
    margin-left: 0;
}

.navigation ul li a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    transition: color 0.3s ease;
}

.navigation ul li a:hover {
    color: #666;
}

.meal-options {
    text-align: center;
}

.meal-options a {
    text-decoration: none;
    color: #333;
    font-size: 16px;
    margin: 0 15px;
    transition: color 0.3s ease;
}

.meal-options a:hover {
    color: #666;
}


   </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <h1>Modern Food Blog</h1>
                <p>Exploring the Art of Food</p>
            </div>
            <div class="meal-options">
                <a href="#">Breakfast</a>
                <a href="#">Lunch</a>
                <a href="#">Dinner</a>
                <a href="#">Dessert</a>
            </div>
            <nav class="navigation">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Recipes</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
           
        </div>
    </header>
    <h1>TEXT</h1>
</body>
</html>
