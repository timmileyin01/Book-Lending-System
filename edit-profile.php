<?php
include "./admin/constants.php";
include './admin/adminControllers/users.php';
include './includes/header.php';


?>

    <main>
        <div class="form-container col-lg-6 border m-5 register-container">
            <form action="edit-profile.php" method="POST">
                <h2>Edit User Profile</h2>
                <?php include("./admin/adminHelpers/formErrors.php"); ?>
                <input type="hidden" name="user_id" value="<?= $_SESSION['update_my_profile'] ?>">
                <input type="hidden" name="user_role" value="<?= $user_role ?>">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" name="firstname" value="<?= $firstname ?>" placeholder="Firstname" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" name="lastname" value="<?= $lastname ?>" placeholder="Lastname" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Matric or Staff ID:</label>
                    <input type="text" class="form-control" name="id_number" value="<?= $id_number ?>" placeholder="Matric No." required>
                </div>                
                <div class="form-group">
                    <label for="phone_num">Phone Number:</label>
                    <input type="text" class="form-control" id="phone_num" value="<?= $phonenumber ?>" name="phonenumber" placeholder="Phone Number" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" value="<?= $email ?>" placeholder="Email Address" required>

                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" value="<?= $password ?>" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="confirmpassword">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirmpassword" value="<?= $passwordConf ?>" name="passwordConf" placeholder="Confirm Password">
                </div>
                <div class="form-group">                    
                    <button type="submit" name="update-profile" class="btn btn-success">Update</button>
                </div>
               
            </form>
        </div>
    </main>
    <?php include './includes/footer.php' ?>