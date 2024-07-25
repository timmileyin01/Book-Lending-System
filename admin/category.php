<?php 
include "./constants.php";
include './adminControllers/categories.php';
include './adminIncludes/header.php';
include './adminIncludes/sidebar.php';



?>
           
            <main role="main" class="main-content col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <?php include './adminIncludes/topnav.php' ?>
                <div id="view-categories">
                    <h2>View Categories</h2>
                    <a href="./add-category.php" class="btn btn-primary float-right">Add Category</a>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Category Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="categories-list">
                                <?php foreach ($categories as $key => $row) { ?>
                                    <tr>
                                    <td><?= $row['category_id'] ?></td>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['description'] ?></td>
                                    <td>
                                    <a href="edit-category.php?category_id=<?= $row['category_id']; ?>" class="text-primary editBtn"><i class="fas fa-edit fa-lg"></i></a>
                                    <a href="category.php?del_category_id=<?= $row['category_id']; ?>" onclick="myFunction()" class="text-danger delBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
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
