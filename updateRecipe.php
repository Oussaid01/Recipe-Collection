<?php

require("connect.php");

$id = $_POST["recipeId"];
$title = $_POST["title"];
$difficulty = $_POST["difficulty"];
$description = $_POST["description"];
$steps = $_POST["steps"];
$time = $_POST["time"];
if (isset($_POST["isPublic"])){$isPublic=1;}else{$isPublic=0;};
$req = "UPDATE recipies SET title='$title', difficulty='$difficulty', description='$description', steps='$steps', time=$time, isPublic=$isPublic WHERE id=$id";
$res = mysqli_query($con, $req);

if (mysqli_affected_rows($con) != 0){
    $message = "Recipe updated successfully!";
}else{
    $message = "Recipe not found !";
}
?>
<script>
    if (window.location.href = "collection.php"){
    alert(<?php echo json_encode($message); ?>);
    }
</script>