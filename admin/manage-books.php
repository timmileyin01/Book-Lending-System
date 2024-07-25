<?php
include "./constants.php";
include './adminControllers/books.php';
include './adminIncludes/header.php';
include './adminIncludes/sidebar.php';

?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <?php include './adminIncludes/topnav.php' ?>
                <div id="view-books">
                    <h2>View Books</h2>
                    <a href="./add-book.php" class="btn btn-primary float-right">Add Book</a>
                    <div class="table-responsive">
                        <table class="table text-center table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>ISBN</th>
                                    <th>Publisher</th>
                                    <th>Quantity</th>
                                    <th>Date Created</th>
                                    <th>Book Cover</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="books-list">
                                <?php foreach ($books as $key => $row) {
                                    $category_id = $row['category_id'];
                                    $category = selectOne('categories', ['category_id' => $category_id]);
                                    ?>  
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $row['title'] ?></td>
                                    <td><?= $row['author'] ?></td>
                                    <td><?= $category['name'] ?></td>
                                    <td><?= $row['isbn'] ?></td>
                                    <td><?= $row['publisher'] ?></td>
                                    <td><?= $row['quantity'] ?></td>
                                    <td><?= $row['created_on'] ?></td>
                                    <td><img src="./uploads/<?= $row['cover'] ?>" width="40px" height="40px" alt=""></td>
                                    <td>
                                    <a href="edit-book.php?book_id=<?= $row['book_id']; ?>" class="text-primary editBtn"><i class="fas fa-edit fa-lg"></i></a>
                                    <a href="manage-books.php?del_book_id=<?= $row['book_id']; ?>" onclick="myFunction()" class="text-danger delBtn"><i class="fas fa-trash-alt fa-lg"></i></a>
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
