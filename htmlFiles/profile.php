<?php
try {
    $db = new mysqli('localhost', 'root', '', 'cake');
    session_start();
    $userID = $_SESSION['userID'];
    $cartID = $_SESSION['CID'];
}catch (Exception $e){
    echo "No data base";
}

?>
<?php
if(isset($_POST['chang']) and !empty($_POST['First']) and !empty($_POST['Last']) and !empty($_POST['Address']) and !empty($_POST['phone'])
    and !empty($_POST['Email']) and !empty($_POST['Password'])) {
    $first = $_POST['First'];
    $final = $_POST['Last'];
    $addres = $_POST['Address'];
    $phon = $_POST['phone'];
    $email = $_POST['Email'];
    $Password = $_POST['Password'];
    $id = 4;
    $error="  ";

    $sql1 = "UPDATE users SET  Firstname='$_POST[First]' ,Lastname='$_POST[Last]',Address='$_POST[Address]',Email='$_POST[Email]'
    ,Phonenumber= '$_POST[phone]' , password='$_POST[Password]'  WHERE  userID = ".$userID." ;";

    if ($db->query($sql1) == TRUE) {
        header('Location:profile.php');
    } else {
        echo 'There were erros while saving the data.';
    }
}
elseif((empty($_POST['First']) or empty($_POST['Last']) or empty($_POST['Address'])  or empty($_POST['phone'])
        or empty($_POST['Email']) or empty($_POST['Password'])) and isset($_POST['chang']) ){
    $error="You have to fill all fields ";
}
else{
    $error=" ";
}
?>


<!DOCTYPE html>
<html lang="en">
<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>cakeShop</title>
    <link rel = "stylesheet" href="../cssFiles/profile.css">
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../javaFiles/profile.js" defer></script>
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




<?php
$sql="select * from users where userID = ".$userID." ;";
$re=mysqli_query($db,$sql);
$row=mysqli_fetch_array($re);

?>
<div id="home" onclick="hideSubMenu()" >
    <div class="container" id="outerDiv" >
        <div id="profileSettingsIcon">
            <img class="img-fluid" id="profileIcon2" src="../images/profileSettings.png" >
            <p class="container" id="userName"> <?php  echo $row['Firstname']." ". $row['Lastname'];?></p>
        </div>
        <div id="profileSettings">
            <form id='information' action="#" method="post">

                <p id="p1">
                    First Name <br>
                    <?php  echo "<input  type='text' class='information-field1' name=First value=".$row['Firstname'].">";?>
                </p>

                <p id = "p2">
                    Last Name <br>
                    <?php  echo " <input type='text' class='information-field1' name=Last value=".$row['Lastname'].">"; ?>
                </p>



                <p>
                    Address <br>
                    <?php  echo " <input type='text' class='information-field' name=Address value=".$row['Address']." >"; ?>
                </p>


                <p>
                    phone number <br>
                    <?php  echo " <input type='tel' class='information-field' name=phone value=".$row['Phonenumber'].">"; ?>
                </p>


                <p>
                    Change Email <br>
                    <?php  echo "  <input type='email' class='information-field' name=Email value=".$row['Email'].">"; ?>
                </p>

                <p>
                    Change Password <br>
                    <?php  echo "  <input type='password' class='information-field' name=Password value=".$row['password'].">"; ?>
                </p>
                <p class="empty" > <?php echo $error ?> </p>

                <button type='submit'class='save-btn'  name="chang">Save Changes</button>
            </form>
        </div>
    </div>
</div>


</body>
</html>