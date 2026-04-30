<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/collection.css">
    <link rel="stylesheet" href="styles/navBar.css">
    <script src="scripts/recipe.js"></script>
    </head>
<body style="overflow: hidden;">

    <!-- navBar -->
    <?php
      include("navbar.php");

      require("connect.php");
      $id = $_SESSION["userID"];
    
      $res=mysqli_query($con, "select * from recipies where ownerId=$id");
      $userRecipies = mysqli_num_rows($res);

      $res2=mysqli_query($con, "select recipeid, title, difficulty, description, steps, time, savedCount, ownerName from savedRecipies,recipies where userid=$id and id=recipeid");
      $userSavedRecipies = mysqli_num_rows($res2);
    ?>

<!-- add recipe php -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){


    $title = $_POST["title"];
    $difficulty = $_POST["difficulty"];
    $description = $_POST["description"];
    $steps = $_POST["steps"];
    $time = $_POST["time"];
    if (isset($_POST["isPublic"])){$isPublic=1;}else{$isPublic=0;};
    $res1 = mysqli_query($con, "select displayName from user where id=$id");
    $tab = mysqli_fetch_array($res1);
    $displayName = $tab[0];
 
    $res = mysqli_query($con, "insert into recipies values ('','$title','$difficulty','$description','$steps','$time','$isPublic','','$displayName','$id');");
    header("Location: collection.php");
}
?>


<div class="recipies-container">
  <div class="collection-header">
            <h3>My Recipes (<?php echo $userRecipies;?>) :</h3>
            <button type="button" class="btn btn-info" onclick="openModal()">+ Add New Recipe</button>
  </div>'
<?php
    if (mysqli_num_rows($res) == 0){
    echo "You do not have any recipe !";    
    }else{
          while ($tab = mysqli_fetch_array($res)){
            echo '
              <div class="flip-card" id="r'.$tab[0].'" onclick="toggleFlip(this)" title="'.$tab[1].'" difficulty="'.$tab[2].'" description="'.$tab[3].'" steps="'.$tab[4].'" time="'.$tab[5].'" isPublic="'.$tab[6].'">
              <div class="flip-card-inner">
                
                <div class="flip-card-front">
                  <div class="image-container">
                    <img src="assets/'.$tab[1].'.png" alt="Recipe Image" />
                    <div class="badge">'.$tab[2].'</div>
                  </div>
                  <div class="content">
                    <h1>'.$tab[1].'</h1>
                    <div class="meta">
                      <div class="stars">★★★★<span style="opacity:0.5">★</span> <span class="rating-count">('.$tab[7].')</span></div>
                      <div class="time">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-timer-icon lucide-timer"><line x1="10" x2="14" y1="2" y2="2"/><line x1="12" x2="15" y1="14" y2="11"/><circle cx="12" cy="14" r="8"/></svg>
                        <span>'.($tab[5]%60 == 0 ? $tab[5] / 60  .' hr' : $tab[5]. ' min').'</span>
                      </div>
                    </div>
                <button class="action-btn" onclick="viewRecipeDetails(event,'.$tab[0].')">View Recipe</button>
                  </div>
                </div>

                <div class="flip-card-back">
                  <div class="testimonial-content">
                    <p class="quote">
                      "'.$tab[3].'"
                      <span class="author">—'.$tab[8].'</span>
                    </p>
                    
                    <div class="button-group">
                      <button class="action-btn" onclick="deleteRecipe(event,'.$tab[0].')">Delete Recipe</button>
                      <button class="action-btn" onclick="openModifyModal(event,`'.$tab[0].'`)">Modify Recipe</button>
                    </div>
                  </div>
                </div>

              </div>
            </div> 
            ';
          }
    }
?>


<?php
    if (mysqli_num_rows($res2) == 0){
       echo '
            <div class="saved-recipies">
              <h3>Saved Recipies ('.$userSavedRecipies.') :</h3>
            </div>';
      echo "You do not have any saved recipe !";    
    }else{
      echo '
            <div class="saved-recipies">
              <h3>Saved Recipies ('.$userSavedRecipies.') :</h3>
            </div>';
            
          while ($tab = mysqli_fetch_array($res2)){
              echo '
              <div class="flip-card"
              onclick="toggleFlip(this)"
            >
              <div class="flip-card-inner">
                
                <div class="flip-card-front">
                  <div class="image-container">
                    <img src="assets/'.$tab[1].'.png" alt="Recipe Image" />
                    <div class="badge">'.$tab[2].'</div>
                  </div>
                  <div class="content">
                    <h1>'.$tab[1].'</h1>
                    <div class="meta">
                      <div class="stars">★★★★<span style="opacity:0.5">★</span> <span class="rating-count">(10)</span></div>
                      <div class="time">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-timer-icon lucide-timer"><line x1="10" x2="14" y1="2" y2="2"/><line x1="12" x2="15" y1="14" y2="11"/><circle cx="12" cy="14" r="8"/></svg>
                        <span>'.($tab[5]%60 == 0 ? $tab[5] / 60  .' hr' : $tab[5]. ' min').'</span>
                      </div>
                    </div>
                <button class="action-btn" onclick="viewRecipeDetails(event,'.$tab[0].')">View Recipe</button>
                  </div>
                </div>

                <div class="flip-card-back">
                  <div class="testimonial-content">
                    <p class="quote">
                      "'.$tab[3].'."
                      <span class="author">—'.$tab[7].'</span>
                    </p>

                              
                    <div class="button-group">
                      <button class="action-btn" onclick="removeSavedRecipe(event,'.$id.','.$tab[0].')">Remove Recipe</button>
                    </div>
                    
                  </div>
                </div>

              </div>
            </div>
            ';
          }
          }
?>






<div class="modal-backdrop fade show" id="backdrop" style="display : none !important;"></div>
<!-- Modal -->
<div class="modal fade show d-block hideModal" tabindex="-1" id ="newRecipeModal">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" data-toggle="modal">Add New Recipe</h5>
        <button type="button" class="btn-close" onclick="closeModal()"></button>
      </div>
      
  <form action="" method="post" onsubmit="return check()">
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-8">
            <label class="form-label">Recipe Title</label>
            <input class="form-control" placeholder="e.g. Pasta Carbonara" name="title" id="title"/>
          </div>

          <div class="col-md-4">
            <label class="form-label">Difficulty</label>
            <select class="form-select" name="difficulty">
              <option value="easy">Easy</option>
              <option value="medium">Medium</option>
              <option value="hard">Hard</option>
            </select>
          </div>

          <div class="col-12">
            <label class="form-label">Description</label>
            <textarea class="form-control" rows="2" name="description" id="description"></textarea>
          </div>

          <div class="col-12">
            <label class="form-label">Preparation Steps</label>
            <textarea class="form-control" rows="4" placeholder="1. Boil water..." name="steps" id="steps"></textarea>
          </div>

          <div class="col-md-6">
            <label class="form-label">Time (minutes)</label>
            <input type="number" class="form-control" placeholder="1" min="1" name="time" id="time">
          </div>

          <div class="col-md-6 d-flex align-items-end">
            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" id="publicCheck" checked name="isPublic">
              <label class="form-check-label" for="publicCheck">Make Recipe Public</label>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" onclick="closeModal()">Cancel</button>
        <button class="btn btn-primary" type="submit">Save Recipe</button>
      </div>
    </div>
  </div>
  </form>
</div>



<!-- Modify Recipe Modal -->
<div class="modal fade show d-block hideModal" id="modifyModal">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modify Recipe</h5>
        <button type="button" class="btn-close" onclick="closeModifyModal()"></button>
      </div>

  <form action="updateRecipe.php" method="post" onsubmit="return check2()">
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-8">
            <label class="form-label">Recipe Title</label>
            <input class="form-control"  placeholder="e.g. Pasta Carbonara" id="recipeCurrentTitle" name="title"/>
          </div>

          <div class="col-md-4">
            <label class="form-label">Difficulty</label>
            <select class="form-select" id="recipeCurrentDifficulty" name="difficulty">
              <option value="easy">Easy</option>
              <option value="medium">Medium</option>
              <option value="hard">Hard</option>
            </select>
            <input type="text" name="recipeId" id="recipeId" style="display:none;">
          </div>

          <div class="col-12">
            <label class="form-label">Description</label>
            <textarea class="form-control" rows="2" id="recipeCurrentDescription" name="description"></textarea>
          </div>

          <div class="col-12">
            <label class="form-label">Preparation Steps</label>
            <textarea class="form-control" rows="4" placeholder="1. Boil water..." id="recipeCurrentSteps" name="steps"></textarea>
          </div>

          <div class="col-md-6">
            <label class="form-label">Time (minutes)</label>
            <input type="number" class="form-control" min="1" placeholder="1" id="recipeCurrentTime" name="time">
          </div>

          <div class="col-md-6 d-flex align-items-end">
            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" id="pubCheck" name="isPublic" style="width=100px !important">
              <label class="form-check-label" for="publicCheck">Make Recipe Public</label>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" onclick="closeModifyModal()">Cancel</button>
        <button class="btn btn-primary" onclick="updateRecipe()">Update Recipe</button>
      </div>
    </div>
  </div>
</form>
</div>


   

 <!-- container -->
</div> 
</body>
</html>