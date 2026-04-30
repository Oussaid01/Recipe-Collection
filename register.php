<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles/register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style.css">
    <script src="scripts/auth.js"></script>
</head>

<?php
require("connect.php");
if ($_SERVER["REQUEST_METHOD"] == "POST"){


    $email = $_POST["email"];
    $password = $_POST["password"];

    $res = mysqli_query($con, "select * from user where mail = '$email'");
    if (mysqli_num_rows($res)!=0){
    header("location: register.php?error=This Email is already in use !");
    }else{
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $res = mysqli_query($con, "insert into user values ('','$email','$hashed_password','','$email')");
    if(mysqli_affected_rows($con)>0){
        header("location: index.php?success=Account Created successfully !");
    }
    }
}
?>




<body>
<?php 
    if (isset($_GET['error'])) {
        echo "<div style='margin:0;width:100%;' class='alert alert-danger' role='alert'>" .$_GET['error']. "</div>";
    }
?>

     <div class="container mt-5">
        <h3 class="title">Create your <br>account</h3>
        <form #loginForm="ngForm" action="register.php" method="post" onsubmit="return register()">
            <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" id="email" name="email" required autocomplete>
            </div>
            <div class="mb-3">
            <label>Password</label>
            <input type="password" class="form-control" id="password" name="password"  required minlength="6" autocomplete>
            </div>
            <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword"  required minlength="6" autocomplete>
            </div>
            <button class="btn btn-primary" type="submit">Register</button>
        </form>
        <img src="assets/chef.png" alt="chefIcon" class="chefIcon">
        <img src="assets/food2.png" alt="food1" class="food1">

    </div>
</body>
</html>