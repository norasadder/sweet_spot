<?php
try{
    $db=new mysqli('localhost','root','','cake');}
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
    <link rel = "stylesheet" href="../cssFiles/delivery.css">
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
            <li class="nav-item "><a class="nav-link" href="employee.php">HOME </a></li>
        </ul>
    </div>
</nav>


<div class=" subMenu" id="subMenu" >
    <a href="empProfile.php">Profile</a>
    <a href="logIn.php">Log Out</a>
</div>

<div id="home" onclick="hideSubMenu()" >
</div>

<div class="containerOrders" >
    <?php
    $query="SELECT * FROM orders where TrackingFlag	=2";
    $query_run=mysqli_query($db, $query);
    $check=mysqli_num_rows($query_run) > 0;

    if( $check){
        while ($row=mysqli_fetch_assoc($query_run)){
            ?>
            <div class="card">
                <div class="img-container">
                    <img class="card-imag" src="../images/orders.png"></img>
                </div>
                <div class="card-description">
                    <?php $oID = $row['OID']; ?>
                    <h2 class="orderID"> order ID : <?php echo $oID ; ?></h2>
                    <p class="orderDate"> order Date : <?php echo $row['ODate']; ?></p>
                    <p class="totalPrice"> total price : <?php echo $row['Totalprice'];?> nis </p>
                </div>


                <form method="post">
                    <p class="orderDetailsButton2"> show Details </p>
                    <input type="submit" name="showOrderDetails" class="orderDetailsButton" value="<?php echo  $row['OID'];?> "/>
                </form>
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
    if(isset($_POST['showOrderDetails'])){
    $OID = $_POST['showOrderDetails'];
   ?>
    <div class="orderDetailsContainer" id="orderDetailsContainer" >
    <p class="orderDetailsP"> Order details</p>
    <?php
    $queryc="SELECT * FROM `orders` WHERE `OID`=".$OID.";";
    $queryrun0= mysqli_query($db, $queryc);
    if (mysqli_num_rows($queryrun0)>0){
        while ($row0=mysqli_fetch_assoc($queryrun0)){
            $CID=$row0['CID'];}
    }


    $query="SELECT * FROM `cart-product` WHERE `CID`=".$CID.";";
    $query_run= mysqli_query($db, $query);

    $check=mysqli_num_rows( $query_run)>0;
    if($check){
    while ($row=mysqli_fetch_assoc($query_run)){
        $productQuantity = $row['Quantity'];
        $productID = $row ['PID'] ;
        $query2="SELECT * FROM product where PID=".$productID;
        $query_run2=mysqli_query($db, $query2);
        $check2=mysqli_num_rows($query_run2) > 0;
        if($check2){
            $row2=mysqli_fetch_assoc($query_run2);
            ?>
            <div class="card2">
                <div class="img2-container">
                    <img class="card2-imag" src=" <?php echo "../images/". $row2['imag']; ?>">
                </div>
                <div class="card2-description">
                    <h2 class="productName"> cake type : <?php echo $row2 ['name'] ; ?></h2>
                    <p class="orderDate"> cake price : <?php echo $row2['price']; ?> nis</p>
                    <p class="qunt"> quantity : <?php echo $productQuantity;?> </p>
                </div>
            </div>


            <?php
        }
        else{
            echo "No Data1";
        }
    }
    ?>

    <form method="post" action="delivery.php" id="buttomform">
        <p class="send"> delivered : </p>
        <p class="orderDetailsButton3"> order delivered </p>
        <input type="submit" name="SendToDelivery" class="SENDButton" value="<?php echo $OID?>"/>
    </form>

</div>
<?php

}
else {
    echo "No Data2";
}
?>
</div>
<?php
}
?>

<?php
if(isset($_POST['SendToDelivery'])){
    $x = $_POST['SendToDelivery'];
    echo $x;
    $sql1 = "UPDATE `orders` SET `TrackingFlag` = 3 WHERE OID =".$x ;
    $query_run= mysqli_query($db, $sql1);
}
?>


</body>
</html>
