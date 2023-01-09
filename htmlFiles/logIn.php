<?php
try {
    $db = new mysqli('localhost', 'root', '', 'cake');
    session_start();
}catch (Exception $e){
    echo "No data base";
}
if(isset($_POST['login'])) {
    if (isset($_POST['Email']) and isset($_POST['password'])) {
        $emai = $_POST['Email'];
        $pass = $_POST['password'];
        $sql = "select * from users where Email='" . $emai . "' AND  password='" . $pass . "'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) == 1) {
            if ($row ['level'] == 0) {
                header('Location:home.php');
            } else {
                header('Location:employee.php');
            }
//        $check=mysqli_num_rows($result) > 0;
            $userID = $row['userID'];
            $_SESSION['userID'] = $userID;

            $sql1 = "SELECT CID FROM `cart` where userID= " . $userID . " ORDER BY CID DESC LIMIT 1 ;";
            $query_run = mysqli_query($db, $sql1);
            $row = mysqli_fetch_assoc($query_run);
            $cartID = $row['CID'];
            $_SESSION['CID'] = $cartID;

            echo $_SESSION['CID'];
            echo $_SESSION['userID'];
        }
        else {
            echo " <script> alert('Invalid Email or Password') </script>";
        }
    }
}
if(isset($_POST['register'])) {
    if (isset($_POST['First']) and isset($_POST['last']) and isset($_POST['Address']) and isset($_POST['phone'])
        and isset($_POST['Email']) and isset($_POST['Password']) and isset($_POST['Confirm'])) {
        $first = $_POST['First'];
        $final = $_POST['last'];
        $addres = $_POST['Address'];
        $phon = $_POST['phone'];
        $email = $_POST['Email'];
        $Password = $_POST['Password'];

        $sql1 = "INSERT INTO users (Firstname, Lastname, Address, Email, Phonenumber, password, level) VALUES
       ('" . $first . "','" . $final . "','" . $addres . "','" . $email . "'," . $phon . "," . $Password . ",0)";

        if ($db->query($sql1) == TRUE) {
            $sql1 = "SELECT userID FROM users ORDER BY userID DESC LIMIT 1;";
            $query_run = mysqli_query($db, $sql1);
            $row = mysqli_fetch_assoc($query_run);
            $userID = $row['userID'];
            $_SESSION['userID'] = $userID;

            $sql1 = "INSERT INTO `cart`(`userID`) VALUES (".$userID.");";
            $query_run = mysqli_query($db, $sql1);

            $sql1 = "SELECT CID FROM `cart` where userID= ".$userID." ORDER BY CID DESC LIMIT 1 ;";
            $query_run = mysqli_query($db, $sql1);
            $row = mysqli_fetch_assoc($query_run);
            $cartID = $row['CID'];
            $_SESSION['CID'] = $cartID;
            header('Location:home.php');
        } else {
            echo 'There were errors while register.';
        }
    } else {
        echo " <script> alert('You have to fill all fields') </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>cakeShop</title>
    <link rel = "stylesheet" href="../cssFiles/logIn.css">
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../javaFiles/logIn.js" defer></script>
    <script src="../node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js" ></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
</head>
<body onload="login()">
<div class=" fullBlock">
    <aside>
        <div class=" form-box">
            <div class=" welcome" >  Welcome </div>
            <div class='button-box'>
                <button type='button'  id='loginButton' onclick="login()">Log In</button>
                <button type='button' id='registerButton' onclick="register()">Register</button>
            </div>
            <form id='login' class='input-group-login' action="#" method="post">
                <input type='text'class='input-field'placeholder='Email' name="Email" required >
                <input type='password'class='input-field'placeholder='Enter Password' name="password" required>
                <button type='submit'class='submit-btn' name="login" >Log In</button>
            </form>
            <form id='register' class='input-group-register' action="#" method="post">
                <input type='text'class='input-field'placeholder='First Name'  name="First" required>
                <input type='text'class='input-field'placeholder='Last Name 'name="last" required>
                <input type='text'class='input-field'placeholder='Address' name="Address" required>
                <input type='tel' class='input-field'placeholder='phone number' name="phone" required>
                <input type='email'class='input-field'placeholder='Email' name="Email" required>
                <input type='password'class='input-field'placeholder='Enter Password' name="Password" required>
                <input type='password'class='input-field'placeholder='Confirm Password' name="Confirm"  required>
                <button type='submit'class='submit-btn' name="register">Register </button>
            </form>
        </div>
    </aside>
</div>
</body>
</html>