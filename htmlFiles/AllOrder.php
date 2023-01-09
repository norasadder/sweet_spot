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
    <link rel = "stylesheet" href="../cssFiles/orders.css">
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
    <a href="profile.php">Profile</a>
    <a href="orders.php">My Orders</a>
    <a href="logIn.php">Log Out</a>
</div>

<div id="home" onclick="hideSubMenu()" >
</div>

<div class="containerOrders" >
    <?php
    $query="SELECT * FROM `orders` ;";
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
                    <h2 class="orderID"> order ID : <?php echo $row ['OID'] ; ?></h2>
                    <p class="orderDate"> order Date : <?php echo $row['ODate']; ?></p>
                    <p class="totalPrice"> total price : <?php echo $row['Totalprice'];?> nis </p>
                </div>
                <?php $OID = $row['OID']; ?>

                <form method="post">
                    <p class="orderDetailsButton2"> show Details </p>
                    <input type="submit" name="showOrderDetails" class="orderDetailsButton" value="<?php echo $OID ?>"/>
                </form>
            </div>

            <?php
        }
    }
    else{
        echo "<p style='color: #e86478 ; font-size: 30px;'> No Orders Yet </p>";
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
        $query="SELECT * FROM `orders` WHERE `OID`= ".$OID." ;";
        $query_run= mysqli_query($db, $query);
        $row=mysqli_fetch_assoc($query_run) ;
        $CID = $row['CID'];

        $query="SELECT * FROM `cart-product` WHERE `CID`=".$CID.";";
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
                    echo "No Data";
                }
            }
            ?>
            <p class="tracking"> Tracking : </p>
            <div class="dots">
                <span class="dot1"></span>
                <span class="road1"></span>
                <span class="dot2"></span>
                <span class="road2"></span>
                <span class="dot3"></span>
            </div>
            <div class="dots">
                <p class="trackingLevels">Processing</p>
                <p class="trackingLevels">On The Way</p>
                <p class="trackingLevels">Delivered</p>

            </div>

            <?php
            $query="SELECT * FROM `orders` WHERE `OID`=".$OID.";";
            $query_run= mysqli_query($db, $query);
            $check=mysqli_num_rows($query_run);
            if($check>0){
                $row=mysqli_fetch_assoc($query_run);
                $trackingFlag = $row['TrackingFlag'];
                if($trackingFlag==1){
                    echo '<style>
        .dot1 {
            background:lightgreen;
        }
        .road1{
            background:lightgreen;
        }
        
        </style>';

                }
                elseif ($trackingFlag==2){
                    echo '<style>
        .dot1 {
            background:lightgreen;
        }
        .road1{
            background:lightgreen;
        }
        .dot2 {
            background:lightgreen;
        }
        .road2{
            background:lightgreen;
        }
        </style>';
                }
                elseif ($trackingFlag==3){
                    echo '<style>
        .dot1 {
            background:lightgreen;
        }
        .road1{
            background:lightgreen;
        }
        .dot2 {
            background:lightgreen;
        }
        .road2{
            background:lightgreen;
        }
        .dot3 {
            background:lightgreen;
        }
        </style>';
                }

            }

            else{

            }
        }
        else {
            echo "No Data";
        }
        ?>
    </div>
    <?php
}
?>

<?php
//if(isset($_POST['showOrderDetails'])){
//    echo $CID ;
//}
//?>


</body>
</html>
