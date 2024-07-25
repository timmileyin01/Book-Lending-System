<?php
include "./admin/constants.php";
include './admin/adminControllers/books.php';
include './includes/header.php';


$sql = "SELECT * FROM `books` WHERE `quantity` > 0 ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$bookss = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$search_te = "";

if (isset($_POST['search-term'])) {
    $search_term = '%' . $_POST['search-term'] . '%';
    $sql = "SELECT * FROM `books` WHERE `title` LIKE  '$search_term' OR `author` LIKE  '$search_term' OR `publisher` LIKE  '$search_term' OR `isbn` LIKE  '$search_term' AND `quantity` >  0 ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $bookss = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $search_te = $_POST['search-term'];
}
?>
<div class="container mt-5">
    <header class="text-center mb-4">
        <h1>Book Catalog</h1>
        <?php if(!empty($search_te)): ?>
        <p class="text-primary h5">You search for : <?= $search_te ?></p>
        <?php endif; ?>
        <form class="d-flex col-lg-4 m-auto" method="post" action="catalog.php">
            <input class="form-control me-2" type="text" name="search-term" placeholder="Search">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
        <?php if (isset($_SESSION['message'])) : ?>
            <div class="col-lg-12 <?php echo $_SESSION['type']; ?>">
                <p>
                    <?= $_SESSION['message'];
                    unset($_SESSION['message']);
                    unset($_SESSION['type']);
                    ?>
                </p>
            </div>
        <?php endif; ?>
    </header>
    <div class="row" id="book-catalog">
        <?php foreach ($bookss as $key => $row) {
            $category_id = $row['category_id'];
            $category = selectOne('categories', ['category_id' => $category_id]);
        ?>
            <div class="col-md-4 col-lg-4 my-2">
                <article class="blog-post">
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
                        <p style="overflow: hidden; white-space: nowrap;text-overflow: ellipsis;"><small class="h5"> Description : </small><?= $row['description'] ?></p>
                        <p style="overflow: hidden; white-space: nowrap;text-overflow: ellipsis;"><small class="h5"> Author : </small><?= $row['author'] ?></p>
                        <p style="overflow: hidden; white-space: nowrap;text-overflow: ellipsis;"><small class="h5"> Publisher : </small><?= $row['publisher'] ?></p>
                        <p style="overflow: hidden; white-space: nowrap;text-overflow: ellipsis;"><small class="h5"> ISBN : </small><?= $row['isbn'] ?></p>
                        <p style="overflow: hidden; white-space: nowrap;text-overflow: ellipsis;"><small class="h5"> Quantity : </small><?= $row['quantity'] ?></p>
                        <a onclick="myFunction()" href="catalog.php?borrow_book_id=<?= $row['book_id'] ?>" class="btn btn-primary float-right">Borrow</a>
                        <a href="single-book.php?book_id=<?= $row['book_id'] ?>" class="btn btn-success">View</a>
                    </div>
                </article>
            </div>
        <?php } ?>
    </div>
</div>

<?php include './includes/footer.php' ?>