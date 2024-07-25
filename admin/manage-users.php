<?php
include "./constants.php";
include './adminControllers/users.php';
include './adminIncludes/header.php';
include './adminIncludes/sidebar.php';


if ($_SESSION['book_user_role'] != 'super_admin') {
    header('location: ' . './');
}
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <?php include './adminIncludes/topnav.php' ?>
    <!-- Manage Users Section -->
    <div id="manage-users" class="mb-4">
        <h2>Manage Users</h2>
        <a href="./add-user.php" class="btn btn-primary float-right">Add User</a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="users-list">
                    <?php foreach ($users as $key => $row) {
                        $user_id = $row['user_id'];
                    ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $row['id_number'] ?></td>
                            <td><?= $row['firstname'] . ' ' . $row['lastname'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['phonenumber'] ?></td>
                            <td><?= $row['user_role'] ?></td>
                            <td>
                                <a href="edit-user.php?user_id=<?= $row['user_id']; ?>" class="text-primary editBtn"><i class="fas fa-edit fa-lg"></i></a>
                                <a href="manage-users.php?del_user_id=<?= $row['user_id']; ?>" onclick="myFunction()" class="text-danger delBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
</div>
</div>




<?php include './adminIncludes/footer.php' ?>