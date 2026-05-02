<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/navBar.css">
    <link rel="stylesheet" href="styles/recipe.css">
    <link rel="stylesheet" href="styles/profile.css">
    <script src="scripts/auth.js"></script>
</head>

<?php
require("connect.php");
include("navbar.php");

$id = $_SESSION["userID"];
$res = mysqli_query($con,"select * from recipies where isPublic = 1");
?>


<body>>

     <div class="container mt-5">
            <h3 class="title mb-5">Users List</h3>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Display Name</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $res = mysqli_query($con, "select * from user where admin = 0");
                if (mysqli_num_rows($res) == 0){
                    echo "<tr><td colspan='4'>No users found</td></tr>";
                }else{
                    while ($tab=mysqli_fetch_array($res)){
                        echo '
                        <tr displayName="'.$tab[4].'" id="l'.$tab[0].'">
                        <th scope="row">'.$tab[0].'</th>
                        <td>'.$tab[1].'</td>
                        <td>'.$tab[4].'</td>
                        <td>
                        <button style="background: none; border: none;" class="btn btn-primary" onclick="openAdminModal('.$tab[0].')">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 3.00001H5C4.46957 3.00001 3.96086 3.21073 3.58579 3.5858C3.21071 3.96087 3 4.46958 3 5.00001V19C3 19.5304 3.21071 20.0392 3.58579 20.4142C3.96086 20.7893 4.46957 21 5 21H19C19.5304 21 20.0391 20.7893 20.4142 20.4142C20.7893 20.0392 21 19.5304 21 19V12M18.375 2.62501C18.7728 2.22719 19.3124 2.00369 19.875 2.00369C20.4376 2.00369 20.9772 2.22719 21.375 2.62501C21.7728 3.02284 21.9963 3.5624 21.9963 4.12501C21.9963 4.68762 21.7728 5.22719 21.375 5.62501L12.362 14.639C12.1245 14.8763 11.8312 15.0499 11.509 15.144L8.636 15.984C8.54995 16.0091 8.45874 16.0106 8.37191 15.9884C8.28508 15.9661 8.20583 15.9209 8.14245 15.8576C8.07907 15.7942 8.03389 15.7149 8.01164 15.6281C7.9894 15.5413 7.9909 15.4501 8.016 15.364L8.856 12.491C8.95053 12.1691 9.12453 11.8761 9.362 11.639L18.375 2.62501Z" stroke="#4D85FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button> 
                        <button style="background: none; border: none;" class="btn btn-danger" onclick="deleteUser('.$tab[0].')">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 11V17M14 11V17M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6M3 6H21M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6" stroke="#FF4D4D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button></td>
                        </tr>   
                        ';
                    }
                }
                ?>
                </tbody>
            </table>
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
        
        <form action="" method="post" onsubmit="return updateUser()">
        <div class="modal-body">
            <input
            class="form-control"
            placeholder="New Display Name"
            name="displayName" id ="displayName"
            >
        </div>

        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" onclick="closeModal()">Cancel</button>
            <button class="btn btn-primary"  type="button" onclick="updateUser()">Save</button>
        </div>
        </div>
        </form>
    </div>
    </div>



        <div class="footer-section" style="display: block;margin: 80px 120px">
            <button class="btn-logout-danger" onclick="logout()">Logout</button>
        </div>


</body>
</html>