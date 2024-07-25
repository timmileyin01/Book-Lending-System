<?php
include "./admin/constants.php";
include './admin/adminControllers/books.php';
include './includes/header.php';

?>
    <main>
        
        <section class="welcome">
            <img src="./images/How to Let Go of Negative Thoughts.jpg" alt="Library Image">          
            <div class="welcome-text">
                <h1>Welcome to the Library Book Lending System</h1>            
                <p>Borrow books, expand your knowledge, and enjoy reading.</p>
                <a href="./catalog.php" class="button">Get Started</a>
            </div>
        </section>
    </main>
    <?php include './includes/footer.php' ?>