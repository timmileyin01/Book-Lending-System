
        <?php
             if (isset($_SESSION['book_user_id']) && $_SESSION['book_user_role'] == 'admin' || $_SESSION['book_user_role'] == 'super_admin'){ 
                $user_avatar = selectOne('users', ['user_id' => $_SESSION['book_user_id']])  
        ?>
       

       

        <header class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <div class="user-info col-lg-12">
                                <div class="col-lg-6">Hello, <?= $user_avatar['firstname'] ?></div>
                                <a href="../logout.php" class="btn btn-danger float-right" onclick="myFunction()">Logout</a>
                                <?php include './adminIncludes/messages.php' ?>
                            </div>
                        </header>
        <?php } ?>

