<?php
include "./constants.php";
include './adminControllers/messages.php';
include './adminIncludes/header.php';
include './adminIncludes/sidebar.php';

?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <?php include './adminIncludes/topnav.php' ?>
    <!-- Manage Users Section -->
    <div id="manage-users" class="mb-4">
        <h2>Manage Messages</h2>
        <a href="./send-message.php" class="btn btn-primary float-right">Send Message</a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Sender ID</th>
                        <th>Receiver ID</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="users-list">
                    <?php foreach ($messages as $key => $row) {
                    ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $row['sender_id'] ?></td>
                            <td><?= $row['receiver_id'] ?></td>
                            <td><?= $row['message'] ?></td>
                            <td><?= $row['date'] ?></td>
                            <td>
                                <a href="notification.php?del_message_id=<?= $row['message_id']; ?>" onclick="myFunction()" class="text-danger delBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
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