<?php
include "./admin/constants.php";
include './admin/adminControllers/books.php';
if (isset($_GET['evidence_book_id'])) {
    $borrow_id = $_GET['evidence_book_id'];
    $borrow = selectOne('borrow', ['borrow_id' => $borrow_id]);
    $book = selectOne('books', ['book_id' => $borrow['book_id']]);
}





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dominion University Library - Lending Evidence</title>
    
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            display: grid;
            place-content: center;
            margin-top: 10%;
        }
        .container{
            padding: 1.5rem;
            border: 1px solid grey;
            box-shadow: 3px 3px 4px 3px grey;
        }
       .title{
            text-align: center;

       }
       .content{
            display: flex;
            flex-direction: column;
            gap: 1rem;
       }
       a{
            text-decoration: none;
            color: black;
       }
       small{
            font-size: 1rem;
            font-weight: 600;
       }
       .div{
        display: grid;
        place-content: center;
       }
       .btn{
        padding: 5px 9px;
        border-radius: 5px;
        background-color: black;
        color: #ffffff;
       }
    </style>
</head>

<body>


    <div class="container">
            <div class="content">
                <h3 class="title">Evidence of Lending</h3>
                <p><small>Title : </small><a href="./single-book.php?book_id=<?= $book['book_id'] ?>"><?= $book['title'] ?></a></p>               
                <p><small> Author : </small><?= $book['author'] ?></p>
                <p><small> Publisher : </small><?= $book['publisher'] ?></p>
                <p><small> ISBN : </small><?= $book['isbn'] ?></p>     
                <p><small>  Date Borrowed : </small><?= $borrow['borrow_date'] ?></p>     
                <p><small>  Date to Return : </small><?= $borrow['return_date'] ?></p>  
                <?php if ($borrow['status'] == 1) {
                    # code...
                 ?>
                <p><small>  Status : </small><span style="color:green; font-weight:600;">Approved</span></p>
                <?php } ?>  
                <div class="div">           
                <a href="#" class="btn" onclick="window.print()">Print</a>         
                </div>      
            </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
</body>

</html>