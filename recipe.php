<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe</title>
    <link rel="stylesheet" href="styles/recipeDetails.css">
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/navBar.css">
</head>
<body>

<?php
require("connect.php");
include("navbar.php");
$id = $_GET['id'];
$res = mysqli_query($con,"select * from recipies where id=$id;");
if (mysqli_num_rows($res) == 0){
    echo "not found";
}
else{
  $tab = mysqli_fetch_array($res);

  $arr = explode("\n", $tab[4]);

  echo '
  
<div class="details-container">
  <header class="recipe-header">
    <div class="image-wrapper">
      <img src="assets/'.$tab[1].'.png" alt="recipe image">
    </div>
    
    <div class="header-content">
      <h1>'.$tab[1].'</h1>
      <div class="meta-row">
        <div class="stars">★★★★<span class="half">★</span> <span> ('.$tab[7].')</span></div>

                <div class="time">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-timer-icon lucide-timer"><line x1="10" x2="14" y1="2" y2="2"/><line x1="12" x2="15" y1="14" y2="11"/><circle cx="12" cy="14" r="8"/></svg>    
                    '.($tab[5]%60 == 0 ? $tab[5] / 60  .' hr' : $tab[5]. ' min').'
                </div>

      </div>
      <p class="main-description">'.$tab[3].'</p>
    </div>
  </header>

  <hr class="divider">


  <section class="prep-section">
    <h2>Preparation Steps :</h2>
    <div class="steps-list" style="overflow: auto !important;height: 200px !important;">
  ';
  for ($i = 0; $i < count($arr); $i++) {
    echo '
      <div class="step-item">
            <div class="step-number">'.($i+1).'</div>
            <p class="step-text">'.$arr[$i].'</p>
      </div>';
}
  echo '
    </div>
  </section>
</div>';
}

?>

</body>
</html>