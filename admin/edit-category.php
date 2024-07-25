<?php
include "./constants.php";
include './adminControllers/categories.php';
include './adminIncludes/header.php';
include './adminIncludes/sidebar.php';



?>

<main role="main" class="main-content col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <?php include './adminIncludes/topnav.php' ?>
    <div id="add-category" class="mb-4">

        <h2>Edit Category</h2>
        <?php include './adminHelpers/formErrors.php'; ?>
        <div class="col-lg-6 border p-3">
            <form id="edit-category-form" method="post" action="./edit-category.php">
                <input type="hidden" name="category_id" value="<?= $category_id ?>">
                <div class="form-group mb-2">
                    <label for="">Category Name</label>
                    <input type="text" id="category-name" class="form-control" name="name" value="<?= $name ?>" placeholder="Category Name" required>
                </div>
                
                    <div class="form-group mb-2">
                        <label for="">Category Descritpion</label>
                        <textarea type="text" id="description" class="form-control" name="description" placeholder="Category Description" rows="3" required><?= $description ?></textarea>
                    </div>

                <div class="form-group">
                    <button type="submit" name="update-category" class="btn btn-primary">Update Category</button>

                </div>

            </form>
        </div>
    </div>


</main>
</div>
</div>

<?php include './adminIncludes/footer.php' ?>