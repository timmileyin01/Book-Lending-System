<?php
include "./admin/constants.php";
include './admin/adminControllers/books.php';
include './includes/header.php';
?>


<main role="main" class="col-12 p-4">
    <div id="view-books">
        <h2>Books you have borrowed</h2>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="col-lg-6 <?php echo $_SESSION['type']; ?>">
                <p>
                    <?= $_SESSION['message'];
                    unset($_SESSION['message']);
                    unset($_SESSION['type']);
                    ?>
                </p>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table text-center table-striped table-bordered">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>ISBN</th>
                        <th>Borrow Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                        <th>Due Days</th>
                        <th>Fine</th>
                        <th>Action</th>
                        <th>Evidence</th>
                    </tr>
                </thead>
                <tbody id="books-list">
                    <?php
                    $borrows = selectAll('borrow', ['user_id' => $_SESSION['book_user_id'], 'returned' => 0]);
                    foreach ($borrows as $key => $row) {
                        $book_id = $row['book_id'];
                        $book = selectOne('books', ['book_id' => $book_id]);
                        $category_id = $book['category_id'];
                        $category = selectOne('categories', ['category_id' => $category_id]);
                        ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $book['title'] ?></td>
                            <td><?= $book['author'] ?></td>
                            <td><?= $category['name'] ?></td>
                            <td><?= $book['isbn'] ?></td>
                            <td><?= $row['borrow_date'] ?></td>
                            <td><?= $row['return_date'] ?></td>
                            <td><?php
                            $return_date = $row['return_date'];
                            $current_date = date('Y-m-d');

                            $new = strtotime($return_date);
                            $new1 = strtotime($current_date);
                            if ($row['status'] == 1 && $new1 <= $new) {
                                echo "<span style='color:green;'>Approved</span>";
                            } elseif ($row['status'] == 1 && $new1 > $new && empty($row['returned_on'])) {
                                echo "<span style='color:red;'>Due</span>";
                            } else {
                                echo "<span class='text-warning'>Pending</span>";
                            }

                            if ($new1 > $new && $return_date != '0000-00-00' && empty($row['returned_on'])) {
                                $diff = $new1 - $new;
                                $fine_days = abs(floor($diff / (60 * 60 * 24)));
                                $setting = selectOne('settings', ['setting_id' => 1]);
                                $fine = $setting['fine'] * $fine_days;

                                ?></td>
                                <td><?= $fine_days . ' day(s)' ?></td>
                                <td><?= '#' . $fine ?></td>
                            <?php } else { ?>
                                <td><?= '0 ' . 'day(s)' ?></td>
                                <td><?= '0' ?></td>
                            <?php }

                            if ($row['status'] == 1) {

                                ?>

                                <td>
                                    <a href="borrowindex.php?return_book_id=<?= $row['borrow_id']; ?>"
                                        class="btn btn-primary editBtn">Return</a>
                                </td>
                            <?php } else { ?>
                                <td>
                                    <span class="btn text-warning">Waiting...</span>
                                </td>
                            <?php } ?>

                            <?php

                            if ($row['status'] == 1) {

                                ?>

                                <td>
                                    <a href="evidence.php?evidence_book_id=<?= $row['borrow_id']; ?>"
                                        class="btn btn-primary editBtn">Generate</a>
                                </td>
                            <?php } else { ?>
                                <td>
                                    <span class="btn text-warning">Waiting...</span>
                                </td>
                            <?php } ?>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
</div>
</div>



<?php
include './includes/footer.php';

?>