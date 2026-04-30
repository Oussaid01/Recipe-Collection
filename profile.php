<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/profile.css">
    <link rel="stylesheet" href="styles/navBar.css">
    <script src="scripts/auth.js"></script>
    </head>
<body>

<?php
include("navbar.php");
$displayName = $_SESSION["displayName"];
$email = $_SESSION["email"];

?>
    
    <div class="profile-container">
        <h1 class="main-title">Profile</h1>


        <div class="field-group">
            <label>Display Name</label>
            <?php echo '<div class="data-value" id="dn" displayName="'.$displayName.'">'.$displayName.'</div>';?>
            <p class="action-link" onclick="openModal()">Change Display Name</p>
        </div>

        <div class="field-group">
            <label>Email</label>
            <div class="data-value"><?php echo $email; ?></div>
        </div>

        <div class="footer-section">
            <button class="btn-logout-danger" onclick="logout()">Logout</button>
        </div>
    </div>


    <div class="modal-backdrop fade show" id="backdrop" style="display: none !important;"></div>

    <!-- Modal -->
    <div class="modal fade show d-block hideModal" id="displayNameModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Update Display Name</h5>
            <button class="btn-close" onclick="closeModal()"></button>
        </div>
        
        <form action="updateUser.php" method="post" onsubmit="return updateUser()">
        <div class="modal-body">
            <input
            class="form-control"
            placeholder="New Display Name"
            name="displayName" id ="displayName"
            >
        </div>

        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" onclick="closeModal()">Cancel</button>
            <button class="btn btn-primary"  type="submit">Save</button>
        </div>
        </div>
        </form>
    </div>
    </div>

</body>
</html>