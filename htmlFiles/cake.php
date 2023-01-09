<?php
try{
    $db=new mysqli('localhost','root','','cake');
    session_start();
    $cartID = $_SESSION['CID'];
}
catch (Exception $e){
    echo "No data base";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>cakeShop</title>
    <link rel = "stylesheet" href="../cssFiles/cake.css">
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../javaFiles/cake.js" defer></script>
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
            <li class="nav-item "><a class="nav-link" href="home.php#home">HOME </a></li>
            <li class="nav-item "><a class="nav-link" href="home.php#about">ABOUT </a></li>
            <li class="nav-item "><a class="nav-link" href="home.php#contactP">CONTACT</a></li>
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
</div>

<div class="containerCake" >
    <?php
    $query="SELECT * FROM product";
    $query_run=mysqli_query($db, $query);
    $check=mysqli_num_rows($query_run) > 0;
    if( $check){
        while ($row=mysqli_fetch_assoc($query_run)){
            ?>
            <div class="card">
                <div class="img-container">
                    <img class="card-imag" src=" <?php echo "../images/". $row['imag']; ?>"></img>
                </div>
                <div class="card-description">
                    <h2 class="card-nam"><?php echo $row ['name'] ; ?></h2>
                    <p class="card-info"> <?php echo $row['Description']; ?></p>
                    <p class="card-price"> <?php echo $row['price'];?> $ </p>


                    <div class="productNumber">
                        <form method="post">

                        </form>
                    </div>
                    <form method="post" style="background: transparent ;">
                        <input type="number" name="quantity" class="quantity" min="1" value="1" >
                        <p class="button3"> Add To Cart</p>
                        <input type="submit" class="addToCart" name="addToCart" value="<?php echo $row ['PID'] ; ?>" style="color: transparent;"/>
                    </form>
               </div>

            </div>

            <?php
        }
    }
    else{
        echo "No Data Is Added";
    }
    ?>
</div>
<?php
if(isset($_POST['addToCart'])){
    $quantity = $_POST['quantity'] ;
    $PID = $_POST['addToCart'] ;
    $query = "SELECT `price` FROM `product` WHERE `PID`= ".$PID." ;" ;
    $query_run= mysqli_query($db, $query);
    $row=mysqli_fetch_assoc($query_run) ;
    $price = $row['price'];
    $price = $price * $quantity ;
    $sql3 = "INSERT INTO `cart-product`(`PID`, `CID`, `Quantity`, `total`) VALUES ( ".$PID." , ".$cartID." , ".$quantity." , ".$price." ) ;";
    $query_run= mysqli_query($db, $sql3);
//    echo $PID ;
//    echo $cartID ;
//    echo $quantity ;
//    echo $price ;
}
?>
</body>
</html>
