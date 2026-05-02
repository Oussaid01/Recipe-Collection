<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/navBar.css">
    <link rel="stylesheet" href="styles/recipe.css">
    <link rel="stylesheet" href="styles/style.css">
    <script src="scripts/recipe.js"></script>
</head>

<?php
require("connect.php");
include("navbar.php");
$admin = $_SESSION["admin"];
$id = $_SESSION["userID"];
$res = mysqli_query($con,"select * from recipies where isPublic = 1");
?>


<body>

    <div class="filter-bar">
        <button class="filter-btn active" onclick="filterRecipes(this, 'all')">All</button>
        <button class="filter-btn" onclick="filterRecipes(this, 'easy')">Easy</button>
        <button class="filter-btn" onclick="filterRecipes(this, 'medium')">Medium</button>
        <button class="filter-btn" onclick="filterRecipes(this, 'hard')">Hard</button>
    </div>

    <div class="recipies-container">

    <?php
    if (mysqli_num_rows($res) == 0){
    echo "No recipies available right now";
    }else{
    while ($tab=mysqli_fetch_array($res)){
        echo '

        <div class="flip-card" data-difficulty="'.strtolower($tab[2]).'"
        onclick="toggleFlip(this)">
        <div class="flip-card-inner">
        
        <div class="flip-card-front">
            <div class="image-container">
            <img src="assets/'.$tab[1].'.png" alt="Recipe Image">
            <div class="badge">'.$tab[2].'</div>
            </div>
            <div class="content">
            <h1>'.$tab[1].'</h1>
            <div class="meta">
                <div class="stars">★★★★<span style="opacity:0.5">★</span> <span class="rating-count">'.$tab[7].'</span></div>
                <div class="time">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-timer-icon lucide-timer"><line x1="10" x2="14" y1="2" y2="2"/><line x1="12" x2="15" y1="14" y2="11"/><circle cx="12" cy="14" r="8"/></svg>
                <span>'.($tab[5] % 60 == 0 ? $tab[5]/60 .' hr' : $tab[5] .' min').'</span>
                </div>
            </div>';
            if ($admin == 0){
                echo '
            <button class="save-btn" onclick="addSavedRecipe(event,'.$id.','.$tab[0].')">Save Recipe ♡</button>
                ';
            }else{
                echo '
                <button class="action-btn" onclick="viewRecipeDetails(event,'.$tab[0].')">View Recipe</button>
                ';
            }
            echo'</div>
        </div>

        <div class="flip-card-back">
            <div class="testimonial-content">
            <p class="quote">
                "'.$tab[3].'."
                <span class="author">—'.$tab[8].'</span>
            </p>
            
            <div class="button-group">
                ';
                if ($admin == 0){
                    echo '
                <button class="action-btn" onclick="viewRecipeDetails(event,'.$tab[0].')">View Recipe</button>
                    ';
                }else{
                    echo '                    
                      <button class="action-btn" onclick="deleteRecipe(event,'.$tab[0].')">Delete Recipe</button>
                       <button class="save-btn" onclick="addSavedRecipe(event,'.$id.','.$tab[0].')">Save Recipe ♡</button>
                    ';
                }
                echo'
            </div>
            </div>
        </div>

        </div>
    </div>
        ';
    }
    }
    ?>

    </div> 

    <script>
        function filterRecipes(btn, difficulty) {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            document.querySelectorAll('.flip-card').forEach(card => {
                if (difficulty === 'all' || card.dataset.difficulty === difficulty) {
                    card.style.display = 'inline-block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>

</body>
</html>