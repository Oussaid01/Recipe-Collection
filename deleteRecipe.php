<?php

require("connect.php");

$id = $_GET["id"];

$res = mysqli_query($con, "delete from recipies where id= $id");

if (mysqli_affected_rows($con) != 0){
    $message = "Recipe deleted successfully!";
}else{
    $message = "Recipe not found !";
}
?>
<script>
    if (window.location.href = "collection.php"){
    alert(<?php echo json_encode($message); ?>);
    }
</script>