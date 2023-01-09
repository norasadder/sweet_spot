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
    <link rel = "stylesheet" href="../cssFiles/delete.css">
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
                    <form method="post" id="formimg">
                        <p class="button3"> Delete Item</p>
                        <input type="submit" name="delete" class="Iadd" value="<?php echo $row ['PID'] ?>">
                        <!--                    <input type="image" alt="Submit" class="Iadd" src="../images/delete.png"  name=delete value="--><?php //echo $row ['PID']; ?><!--" >-->
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

    <?php
    if(isset($_POST['delete'])){
        $x = $_POST['delete'];
        $sql3 = "DELETE FROM `product` WHERE PID=".$x;
        $query_run= mysqli_query($db, $sql3);

    }
    ?>


</div>
</body>
</html>
