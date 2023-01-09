<?php
try{
    $db=new mysqli('localhost','root','','cake');
    session_start();
    $userID = $_SESSION['userID'];
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
    <link rel = "stylesheet" href="../cssFiles/cart.css">
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../javaFiles/orders.js" defer></script>
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

<div class="containerItems" >
    <?php
    $query="SELECT * FROM `cart-product` WHERE `CID`= ".$cartID." ;";
    $query_run= mysqli_query($db, $query);
    $check=mysqli_num_rows($query_run);
    if($check>0){
        while ($row=mysqli_fetch_assoc($query_run)){
            $productQuantity = $row['Quantity'];
            $productID = $row ['PID'] ;
            $query2="SELECT * FROM product where PID=".$productID;
            $query_run2=mysqli_query($db, $query2);
            $check2=mysqli_num_rows($query_run2) > 0;
            if($check2){
                $row2=mysqli_fetch_assoc($query_run2);
                ?>
                <div class="card">
                    <div class="img-container">
                        <img class="card-imag" src=" <?php echo "../images/". $row2['imag']; ?>">
                    </div>
                    <div class="card-description">
                        <h2 class="orderID"> cake type : <?php echo $row2 ['name'] ; ?></h2>
                        <p class="orderDate"> cake price : <?php echo $row2['price']; ?></p>
                        <p class="totalPrice"> quantity : <?php echo $productQuantity;?> </p>
                    </div>
                    <form method="post" >
                        <p class="deleteItemButton2"> delete Item </p>
                        <input type="submit" name="deleteItem" class="deleteItemButton" value="<?php echo $productID ?>"/>
                    </form>

                </div>
                <?php
            }
            else{
                echo "No Data";
            }
        }
        ?>
    <div class="card3">
        <form method="post" style="background: transparent ;">
            <input type="submit" class="placeOrder" name="placeOrder" value="place Order" />
        </form>
    </div>


    <?php
    }
    else {
        echo "<p style='color: #e86478 ; font-size: 30px; font-family: 'Sofia';> No Items in your cart </p>";
    }
    ?>
</div>

<?php
if(isset($_POST['deleteItem'])) {
    $productID = $_POST['deleteItem'] ;
    $query = "DELETE FROM `cart-product` WHERE `PID`=".$productID." and `CID`= ".$cartID." ;";
    $query_run = mysqli_query($db, $query);
}
if(isset($_POST['placeOrder'])){
    $query="select sum(total) from `cart-product` where cid= ".$cartID." ;";
    $query_run = mysqli_query($db, $query);
    $row=mysqli_fetch_assoc($query_run);
    $totalPrice = $row['sum(total)'];
    $query = "INSERT INTO `orders`(`CID`, `userID`, `ODate`, `Totalprice`, `TrackingFlag`) VALUES ( 
    ".$cartID.",".$userID.",'".date("Y-m-j")."',".$totalPrice.",1);";
    $query_run = mysqli_query($db, $query);
    $query="INSERT INTO `cart` (`userID`) VALUES (".$userID.")";
    $query_run = mysqli_query($db, $query);

    $query="SELECT CID FROM `cart` where userID= ".$userID." ORDER BY CID DESC LIMIT 1 ;";
    $query_run = mysqli_query($db, $query);
    $row=mysqli_fetch_assoc($query_run);
    $cartID = $row['CID'];
    $_SESSION['CID'] = $cartID;
}

?>
</body>
</html>
