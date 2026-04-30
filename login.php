<?php

require("connect.php");
session_start();

$email = $_POST["email"];
$password = $_POST["password"];

$res = mysqli_query($con, "select * from user where mail = '$email'");
if (mysqli_num_rows($res)!=0){
    $tab = mysqli_fetch_array($res);
    // echo "".$tab[2];
    // echo "<br>".password_hash($password, PASSWORD_DEFAULT);
    if (password_verify($password, $tab[2])) {
        $_SESSION["userID"] = $tab[0];
        $_SESSION["displayName"]=$tab[4];
        $_SESSION["email"]=$tab[1];
        $_SESSION["admin"]=$tab[3];
        header("location: home.php");
    }
    else {
        header("location: index.php?error=Wrong email or password !");
    }
}
?>