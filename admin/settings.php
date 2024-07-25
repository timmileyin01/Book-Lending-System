<?php
include "./constants.php";
include './adminControllers/settings.php';
include './adminIncludes/header.php';
include './adminIncludes/sidebar.php';



if ($_SESSION['book_user_role'] != 'super_admin') {
    header('location: ' . './');
}

?>

<main role="main" class="main-content col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <?php include './adminIncludes/topnav.php' ?>
    <div id="add-category" class="mb-4">

        <h2>Update Settings</h2>
        <?php include './adminHelpers/formErrors.php'; ?>
        <div class="col-lg-6 border p-3">
            <form id="settings" method="post" action="./settings.php" enctype="multipart/form-data">
                <input type="hidden" name="setting_id" value="1">
                <div class="form-group mb-2">
                    <label for="">Website Title</label>
                    <input type="text" id="category-name" class="form-control" name="title" value="<?= $websiteTitle ?>" placeholder="Website Title" required>
                </div>

                <div class="form-group mb-2">
                    <label for="">About</label>
                    <textarea type="text" id="about" class="form-control" name="about" placeholder="About Website" rows="3" required><?= $websiteAbout ?></textarea>
                </div>
                <div class="form-group mb-2">
                    <label for="">Max File Upload</label>
                    <textarea type="number" id="about" class="form-control" name="max_upload" placeholder="Max File Upload" rows="3" required><?= $websiteMax_upload ?></textarea>
                </div>
                <div class="form-group mb-2">
                    <label for="">Fine per day</label>
                    <textarea type="number" id="about" class="form-control" name="fine" placeholder="What will be the fine for late returm of books per day" rows="3" required><?= $websiteFine ?></textarea>
                </div>

                <div class="form-group mb-2">
                    <label for="">Website Logo</label>
                    <small>Leave empty if you do not want to change logo</small>
                    <input type="file" class="form-control" name="logo">
                </div>

                <div class="form-group">
                    <button type="submit" name="update-setting" class="btn btn-primary">Update</button>

                </div>

            </form>
        </div>
    </div>


</main>
</div>
</div>

<?php include './adminIncludes/footer.php' ?>