<?php

require("connect.php");
$id = $_GET["userID"];
$displayName = $_GET["displayName"];
$req = "UPDATE user SET displayName='$displayName' WHERE id=$id";
$res = mysqli_query($con, $req);

if (mysqli_affected_rows($con) != 0){
    if ($_SESSION["admin"] == 0) {
        $_SESSION["displayName"] = $displayName;
    }
    $_SESSION["displayName"] = $displayName;
    $message = "DisplayName updated successfully!";
}else{
    $message = "User already updated !";
}
?>
<script>
    if (window.location.href = "admin.php"){
    alert(<?php echo json_encode($message); ?>);
    }
</script>