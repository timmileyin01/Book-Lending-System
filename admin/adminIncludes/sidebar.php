<aside class="sidebar col-md-3 col-lg-2 p-0">
    <div class="logo text-center">
        <img src="./uploads/<?= $setting['logo'] ?>" alt="Dominion University Library" class="img-fluid">
    </div>
    <nav class="menu">
        <ul class="nav flex-column">
            <li class="nav-item"><a href="./" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item"><a href="./manage-books.php" class="nav-link"><i class="fas fa-book"></i> Manage
                    Books</a></li>
            <li class="nav-item"><a href="./category.php" class="nav-link"><i class="fas fa-list"></i> Manage
                    Categories</a></li>
            <li class="nav-item"><a href="./book-request.php" class="nav-link"><i class="fas fa-book-reader"></i> Book
                    Issue Requests</a></li>
            <li class="nav-item"><a href="./book-request-history.php" class="nav-link"><i
                        class="fas fa-book-reader"></i> Book Request History</a></li>
            <?php if (isset($_SESSION['book_user_role']) && $_SESSION['book_user_role'] == 'super_admin') { ?>
                <li class="nav-item"><a href="./manage-users.php" class="nav-link"><i class="fas fa-users"></i> Manage
                        Users</a></li>
                <li class="nav-item"><a href="./settings.php" class="nav-link"><i class="fas fa-bell"></i> Website
                        Settings</a></li>
            <?php } ?>
            <li class="nav-item"><a href="./notification.php" class="nav-link"><i class="fas fa-bell"></i> Send
                    Notifications</a></li>
        </ul>
    </nav>
</aside>