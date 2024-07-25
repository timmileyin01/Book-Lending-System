<?php
include "./constants.php";
include './adminControllers/messages.php';
include './adminIncludes/header.php';
include './adminIncludes/sidebar.php';



?>

<main role="main" class="main-content col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <?php include './adminIncludes/topnav.php' ?>
    <div id="add-book" class="col-lg-6 mb-4 border">
        <h2>Send Message</h2>
        <?php include './adminHelpers/formErrors.php' ?>
        <form id="add-book-form" action="send-message.php" method="post">
            <div class="form-group">
                <label for="book-category">Select Receiver</label>
                <select name="receiver_id" class="form-control" id="" required>
                    <option value="">Select User</option>
                    <?php $users = "SELECT * FROM users WHERE user_role = 'student'";
                    $stmt8 = $conn->prepare($users);
                    $stmt8->execute();
                    $data = $stmt8->get_result()->fetch_all(MYSQLI_ASSOC);
                    foreach ($data as $key => $row) :
                    ?>
                        <?php if (!empty($receiver_id) && $receiver_id == $row['user_id']) : ?>
                            <option selected value="<?= $row['user_id']; ?>"><?= $row['firstname'] . ' ' . $row['lastname']; ?></option>
                        <?php else : ?>
                            <option value="<?= $row['user_id']; ?>"><?= $row['firstname'] . ' ' . $row['lastname']; ?></option>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </select>
            </div>


            <div class="form-group">
                <label for="">Message</label>

                <textarea class="form-control" name="message" placeholder="Your Message..." rows="4" required><?= $message ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="add-message">Send</button>
        </form>
    </div>


</main>
</div>
</div>

<?php include './adminIncludes/footer.php' ?>