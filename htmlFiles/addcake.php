<?php
try {
    $db = new mysqli('localhost', 'root', '', 'cake');


}catch (Exception $e){
    echo "No data base";
}?>


<!DOCTYPE html>
<html lang="en">
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>cakeShop</title>
    <link rel = "stylesheet" href="../cssFiles/addcake.css">
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

</div>



<div class="container" id="outerDiv" >
    <div id="addIcon">
        <p class="container" id="AddingCake">Adding Cake</p>
        <img class="img-fluid" id="cakeIcon2" src="../images/cakechang.png" >

    </div>
    <div id="profileSettings">

        <?php
        $query= "SELECT PID FROM `product`  ORDER BY PID DESC LIMIT 1 ;";
        $query_run= mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($query_run);
        $CreatedId = $row['PID'];
        $CreatedId = $CreatedId + 1 ;
        $error = "" ;
        ?>

        <form id='information' action="#" method="post" autocomplete="off" >

            <p id="p1">
                cake ID <br>
                <input  type='text' class='information-field1' name=ID value="<?php echo $CreatedId ; ?>" >
            </p>

            <p id = "p2">
                Cake Name <br>
                <input type='text' class='information-field1' name="Name" required >
            </p>



            <p>
                imge extend <br>
                <input type='text' class='information-field' name="extend"  required>
            </p>


            <p>
                details <br>
                <input type='tel' class='information-field' name="details" required>
            </p>


            <p>
                Price <br>
                <input type='text' class='information-field' name="Price" required>
            </p>

            <p class="empty" > <?php echo $error ?> </p>
            <form>
                <input type='submit' class='save-btn'  name="add" value="Add Cake" />
            </form>


        </form>
    </div>
</div>

<?php
if(isset($_POST['add'])){
    if(isset($_POST['ID'])and isset($_POST['Name'])and isset($_POST['extend'])and isset($_POST['details'])
        and isset($_POST['Price'])){
       echo "hello" ;
        $id= $_POST['ID'];
        $name = $_POST['Name'];
        $img = $_POST['extend'];
        $deteals = $_POST['details'];
        $price = $_POST['Price'];
        $sql1="INSERT INTO 	product	 (PID , price, imag, Description, name) VALUES
       (".$id.",". $price.",'".$img."','".$deteals."','".$name."')";
        if($db->query($sql1) == TRUE){
            header('Location:addcake.php');

        }
        else{
            echo 'There were erros while saving the data.';
        }
    }
    elseif ((empty($_POST['ID'])or empty($_POST['Name'])or empty($_POST['extend'])or empty($_POST['details'])
            or empty($_POST['Price']) ) and isset($_POST['add'])  ){
        $error=" Please, there is an empty field Recheck";}
    else{ $error=" ";}
}
?>

</div>
</body>
