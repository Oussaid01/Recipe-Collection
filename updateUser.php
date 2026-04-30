<?php

require("connect.php");
session_start();
$id = $_SESSION["userID"];
$displayName = $_POST["displayName"];
$req = "UPDATE user SET displayName='$displayName' WHERE id=$id";
$res = mysqli_query($con, $req);

if (mysqli_affected_rows($con) != 0){
    $_SESSION["displayName"] = $displayName;
    $message = "DisplayName updated successfully!";
}else{
    $message = "User already updated !";
}
?>
<script>
    if (window.location.href = "profile.php"){
    alert(<?php echo json_encode($message); ?>);
    }
</script>