<?php
include "./constants.php";
include './adminControllers/books.php';
include './adminIncludes/header.php';
include './adminIncludes/sidebar.php';

?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <?php include './adminIncludes/topnav.php' ?>
    <!-- Book Requests Section -->
    <div id="book-requests" class="mb-4">
        <h2>Book Request History</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>User ID</th>
                        <th>Category</th>
                        <th>ISBN</th>
                        <th>Borrow Date</th>
                        <th>To Return on</th>
                        <th>Date Returned</th>
                        <th>Days Due</th>
                        <th>Fine</th>
                    </tr>
                </thead>
                <tbody id="requests-list">
                    <?php
                    $i = 0;
                    $borrows = selectAll('borrow', ['returned' => 1]);
                    foreach ($borrows as $key => $row) {
                        $book_id = $row['book_id'];
                        $book = selectOne('books', ['book_id' => $book_id]);
                        $category_id = $book['category_id'];
                        $category = selectOne('categories', ['category_id' => $category_id]);
                        $user_id = $row['user_id'];
                        $user = selectOne('users', ['user_id' => $user_id]);
                        ?>
                        <tr>
                            <td><?= $i += 1 ?></td>
                            <td><?= $book['title'] ?></td>
                            <td><?= $user['id_number'] ?></td>
                            <td><?= $category['name'] ?></td>
                            <td><?= $book['isbn'] ?></td>
                            <td><?= $row['borrow_date'] ?></td>
                            <td><?= $row['return_date'] ?></td>
                            <td><?= $row['returned_on'] ?></td>
                            <?php
                            $return_date = $row['return_date'];
                            $returned_on = $row['returned_on'];

                            $new = strtotime($return_date);
                            $new1 = strtotime($returned_on);


                            if ($new1 > $new && $return_date != '0000-00-00') {
                                $diff = $new1 - $new;
                                $fine_days = abs(floor($diff / (60 * 60 * 24)));
                                $setting = selectOne('settings', ['setting_id' => 1]);
                                $fine = $setting['fine'] * $fine_days;

                                ?>
                                <td><?= $fine_days . ' day(s)' ?></td>
                                <td><?= '#' . $fine ?></td>
                            <?php } else { ?>
                                <td><?= '0 ' . 'day(s)' ?></td>
                                <td><?= '0' ?></td>
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





<?php include './adminIncludes/footer.php' ?>