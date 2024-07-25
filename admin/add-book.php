<?php
include "./constants.php";
include './adminControllers/books.php';
include './adminIncludes/header.php';
include './adminIncludes/sidebar.php';



?>

<main role="main" class="main-content col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <?php include './adminIncludes/topnav.php' ?>
    <div id="add-book" class="col-lg-6 mb-4 border">
        <h2>Add Book</h2>
        <?php include './adminHelpers/formErrors.php' ?>
        <form id="add-book-form" action="add-book.php" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="book-title">Book Title</label>
                    <input type="text" class="form-control" id="book-title" name="title" value="<?= $title ?>" placeholder="Book Title" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="book-author">Book Author</label>
                    <input type="text" class="form-control" id="book-author" name="author" value="<?= $author ?>" placeholder="Book Author" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-12">
                    <label for="">Book Description</label>
                    
                      <textarea class="form-control"name="description" placeholder="Book Description" rows="3" required><?= $description ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="book-category">Category</label>
                    <select name="category_id" class="form-control" id="" required>
                        <option value="">Select Book Category</option>
                        <?php $bookView = "SELECT * FROM categories";
                        $stmt8 = $conn->prepare($bookView);
                        $stmt8->execute();
                        $data = $stmt8->get_result()->fetch_all(MYSQLI_ASSOC);
                        foreach ($data as $key => $row) :
                        ?>
                        <?php if (!empty($category_id) && $category_id == $row['category_id']): ?>
                            <option selected value="<?= $row['category_id']; ?>"><?= $row['name']; ?></option>
                        <?php else: ?>
                            <option value="<?= $row['category_id']; ?>"><?= $row['name']; ?></option>
                        <?php endif; ?>

                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="book-isbn">ISBN</label>
                    <input type="text" class="form-control" name="isbn" value="<?= $isbn ?>" id="book-isbn" placeholder="ISBN" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="book-publisher">Publisher</label>
                    <input type="text" class="form-control" name="publisher" value="<?= $publisher ?>" id="book-publisher" placeholder="Publisher" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="book-quatity">Quantity</label>
                    <input type="text" class="form-control" name="quantity" value="<?= $quantity ?>" id="book-publisher" placeholder="Quantity" required>
                </div>

            </div>
            <div class="form-group">
                <label for="">Book Cover</label>
                <input type="file" class="form-control" name="cover" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add-book">Add Book</button>
        </form>
    </div>


</main>
</div>
</div>

<?php include './adminIncludes/footer.php' ?>