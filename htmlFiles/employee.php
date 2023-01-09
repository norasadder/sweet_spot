<?php
?>


<!DOCTYPE html>
<html lang="en">
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>cakeShop</title>
    <link rel = "stylesheet" href="../cssFiles/employee.css">
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../javaFiles/employee.js" defer></script>
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
            <li class="nav-item "><a class="nav-link" href="employee.php"> HOME </a></li>

        </ul>
    </div>


</nav>


<div class=" subMenu" id="subMenu" >
    <a href="empProfile.php">Profile</a>
    <!--    <a href="orders.php">My Jop</a>-->
    <a href="logIn.php">Log Out</a>
</div>


<div id="home" onclick="hideSubMenu()" >
    <pre class="container storeName">
        The Sweet Spot
    </pre>
</div>


<div class="container" id="outerDiv" >
    <div class="section">
        <p class="textIcon"> To Prepare</p>
        <a  href="showorder.php">
            <img class="Icon" src="../images/order.png" >
        </a>

    </div>

    <div class="section">
        <p class="textIcon">Add New Cake </p>
        <a  href="addcake.php" >
            <img class="Icon" src="../images/addcake.png" >
        </a>

    </div>

    <div class="section" >
        <p class="textIcon">Delivery  </p>
        <a  href="delivery.php"  >
            <img class="Icon" src="../images/delivery.png" >
        </a>

    </div>
    <div class="section">
        <p class="textIcon">All Order </p>
        <a  href="AllOrder.php">
            <img class="Icon" src="../images/all.png" >
        </a>

    </div>

    <div class="section">
        <p class="textIcon"> Show And Delete </p>
        <a  href="delete.php">
            <img class="Icon" src="../images/del.png" >
        </a>

    </div>


</div>
</body>
</html>