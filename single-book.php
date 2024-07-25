<?php
include "./admin/constants.php";
include './admin/adminControllers/books.php';
include './includes/header.php';
?>
<div class="container mt-5">
    <header class="text-center mb-4">
        <h1>Book Details</h1>
    </header>
    <div class="row" id="book-catalog">
        <?php
        if (isset($_GET['book_id'])) {
            $book_id = $_GET['book_id'];
        }
        $row = selectOne('books', ['book_id' => $book_id]);
        $category_id = $row['category_id'];
        $category = selectOne('categories', ['category_id' => $category_id]);
        ?>
        <div class="col-12 my-2 d-flex justify-content-center">
            <article class="blog-post col-4">
                <img width="auto" height="300px" src="./admin/uploads/<?= $row['cover']; ?>" alt="">
                <a href="#" class="tag"><?= $category['name'] ?></a>
                <?php if ($row['status'] == 1) {
                    ?>
                    <a href="#" class="tag1">Available</a>
                <?php } else { ?>
                    <a href="#" class="tag1">Not Available</a>
                <?php } ?>

                <div class="content">

                    <h5><a href="./single-book.php?book_id=<?= $row['book_id'] ?>"><?= $row['title'] ?></a></h5>
                    <p><small class="h5"> Description : </small><?= $row['description'] ?></p>
                    <p><small class="h5"> Author : </small><?= $row['author'] ?></p>
                    <p><small class="h5"> Publisher : </small><?= $row['publisher'] ?></p>
                    <p><small class="h5"> ISBN : </small><?= $row['isbn'] ?></p>
                    <p><small class="h5"> Quantity : </small><?= $row['quantity'] ?></p>
                    <a onclick="myFunction()" href="borrowindex.php?borrow_book_id=<?= $row['book_id'] ?>"
                        class="btn btn-primary">Borrow</a>
                </div>
            </article>
        </div>
    </div>
</div>

<?php include './includes/footer.php' ?>