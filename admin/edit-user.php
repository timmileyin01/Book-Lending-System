<?php
include "./constants.php";
include './adminControllers/users.php';
include './adminIncludes/header.php';
include './adminIncludes/sidebar.php';

if ($_SESSION['book_user_role'] != 'super_admin') {
    header('location: ' . './');
}

?>

<main role="main" class="main-content col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <?php include './adminIncludes/topnav.php' ?>
    <div id="add-book" class="col-lg-6 mb-4 border">
        <form action="edit-user.php" method="POST">
                    <h2>Edit User</h2>
                    <?php include("./adminHelpers/formErrors.php"); ?>
                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
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
                        <label for="">User Role</label>
                        <select class="form-control" name="user_role" id="">
                            <option>Select User Role...</option>
                            <?php if ($user_role == 'student'): ?>
                            <option selected value="student">Student</option>
                            <option value="admin">Admin</option>
                            <option value="super_admin">Super Admin</option>
                        <?php elseif($user_role == 'admin'): ?>
                            <option selected value="student">Student</option>
                            <option selected value="admin">Admin</option>
                            <option selected value="super_admin">Super Admin</option>
                        <?php elseif($user_role == 'super_admin'): ?>
                            <option selected value="student">Student</option>
                            <option value="admin">Admin</option>
                            <option selected value="super_admin">Super Admin</option>
                        <?php else: ?>
                            <option value="student">Student</option>
                            <option value="admin">Admin</option>
                            <option value="super_admin">Super Admin</option>
                        <?php endif; ?>
                        </select>
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
                        <button type="submit" name="edit-user" class="btn btn-primary">Submit</button>
                    </div>
                </form>
    </div>


</main>
</div>
</div>

<?php include './adminIncludes/footer.php' ?>