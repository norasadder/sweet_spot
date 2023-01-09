<!DOCTYPE html>
<html lang="en">
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>cakeShop</title>
    <link rel = "stylesheet" href="../cssFiles/home.css">
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../javaFiles/home.js" defer></script>
    <script src="../node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js" ></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">

</head>

<body >

<nav class="navbar navbar-expand-sm fixed-top ">
    <a class="navbar-brand m-0 h1 " onclick="subMenuSH()" >
        <img class="d-inline-block img" src="../images/signin.png" >
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNav"
    aria-label="toggle Navigation " aria-controls="myNav" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="myNav">
        <ul class="navbar-nav topList ">
            <li class="nav-item "><a class="nav-link" href="#home">HOME </a></li>
            <li class="nav-item "><a class="nav-link" href="#about">ABOUT </a></li>
            <li class="nav-item "><a class="nav-link" href="#contactP">CONTACT</a></li>
            <li class="nav-item "><a class="nav-link" href="cake.php">CAKES </a></li>
        </ul>
    </div>
    <a class="navbar-brand m-0 " href="cart.php">
        <img class="d-inline-block align-top img" src="../images/cart2.png" ></a>
</nav>


<div class=" subMenu" id="subMenu" >
    <a href="profile.php">Profile</a>
    <a href="orders.php">My Orders</a>
    <a href="logIn.php">Log Out</a>
</div>


<div id="home" onclick="hideSubMenu()" >
    <pre class="container storeName">
        The Sweet Spot
    </pre>
</div>

<div class="container" id ="about" onclick="hideSubMenu()">
    <img class="img-fluid" src="../images/about.gif" style="height: 70%" >
    <div id="text">
        <p id="aboutTitle"> About us </p>
        <p id="aboutCon"> Our shop established in 2001.<br>
            it started as small project in home <br>
            Then we upgraded it to big shop with modern skills and chefs from around the world
        </p>
    </div>

</div>

<p id="contactP">CONTACT</p>
<nav class="navbar navbar-expand-sm ">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNav2"
            aria-label="toggle Navigation " aria-controls="myNav2" aria-expanded="false" >
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="myNav2">
        <ul class="navbar-nav bottomList" >
            <li class="nav-item "> <a class="nav-link"  href="https://www.facebook.com/" > <img class="iconButton" src="../images/face.png"></a></li>
            <li class="nav-item "><a class="nav-link" href="https://www.instagram.com/"><img class="iconButton" src="../images/insta.png"></a></li>
            <li class="nav-item "><a class="nav-link" href="https://web.whatsapp.com/"><img class="iconButton" src="../images/wats.png"></a></li>
            <li class="nav-item "><a class="nav-link"  href="mailto:Apiceofcake@shop.com" ><img class="iconButton" src="../images/email.png"></a></li>
        </ul>
    </div>
</nav>




</body>
</html>