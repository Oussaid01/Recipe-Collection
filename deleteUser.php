<?php

require("connect.php");

$id = $_GET["id"];

$res = mysqli_query($con, "delete from user where id= $id");

if (mysqli_affected_rows($con) != 0){
    $message = "User deleted successfully!";
}else{
    $message = "User not found !";
}
?>
<script>
    if (window.location.href = "admin.php"){
    alert(<?php echo json_encode($message); ?>);
    }
</script>