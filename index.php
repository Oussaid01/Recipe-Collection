<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/login.css">
    <script src="scripts/auth.js"></script>
</head>


<?php
?>

<body>
  <?php 
    if (isset($_GET['error'])) {
        echo "<div style='margin:0;width:100%;' class='alert alert-danger' role='alert'>" .$_GET['error']. "</div>";
    }
?>
<?php 
  if (isset($_GET['success'])) {
      echo "<div class='alert alert-success' role='alert'>" .$_GET['success']. "</div>";
  }
?>

    <div class="container mt-5">
    <h3 class="title">Log in to your <br>account</h3>
      <form #loginForm="ngForm" action = "login.php" onsubmit="return login()" method = "post">
        <div class="mb-3">
          <label>Email</label>
          <input type="email" class="form-control" id="email" name="email" autocomplete>
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" class="form-control" id="password" name="password" minlength="6">
        </div>
        <button class="btn btn-primary" type="submit">Log In</button>
      </form>
      <img src="assets/chef.png" alt="chefIcon" class="chefIcon">
      <img src="assets/food2.png" alt="food1" class="food1">
      
      <a href="register.php" class="registerLink">Don't Have An Account?</a>

    </div>

</body>
</html>