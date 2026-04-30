<?php
require("connect.php");
session_start();

if (isset($_GET["userid"]) && isset($_GET["recipeid"])) {
    
    $userid = $_GET["userid"];
    $recipeid = $_GET["recipeid"];

    $res1 = mysqli_query($con, "select ownerId from recipies where id=$recipeid");
    $tab = mysqli_fetch_array($res1);
    if ($tab[0] == $userid){
        $message = "You own this recipe !";
    }else{

        $res2= mysqli_query($con,"select * from savedRecipies where userid = $userid and recipeid=$recipeid");
        if (mysqli_num_rows($res2)!=0){
            $message = "Recipe already saved !";
        }else{
        $req = "insert into savedRecipies values($userid,$recipeid);";
        mysqli_query($con, $req);

        if (mysqli_affected_rows($con) > 0) {
            $res2 = mysqli_query($con, "update recipies set savedCount = savedCount +1 where id = $recipeid");
            $message = "Recipe saved successfully!";
        } else {
            $message = "Recipe not found !";
        }
    }
}
}
?>

<script>
    alert("<?php echo $message; ?>");
    window.location.href = "home.php";
</script>