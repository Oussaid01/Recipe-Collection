<?php
require("connect.php");

if (isset($_GET["userid"]) && isset($_GET["recipeid"])) {
    
    $userid = $_GET["userid"];
    $recipeid = $_GET["recipeid"];

    $req = "delete from savedRecipies where userid = $userid and recipeid = $recipeid";
    mysqli_query($con, $req);

    if (mysqli_affected_rows($con) > 0) {
        $res2 = mysqli_query($con, "update recipies set savedCount = savedCount - 1 where id = $recipeid");
        $message = "Recipe removed successfully!";
    } else {
        $message = "Recipe not found !";
    }
}
?>

<script>
    alert("<?php echo $message; ?>");
    window.location.href = "collection.php";
</script>