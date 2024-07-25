<?php
include "./admin/constants.php";
include './admin/adminControllers/books.php';
include './includes/header.php';

$myMessage = selectAll('messages', ['receiver_id' => $_SESSION['book_user_id']]);

?>
<style>
    body {
        background-image: linear-gradient(90deg, #74EBD5 0%, #9FACE6 100%);

        min-height: 100vh;
    }

    ::-webkit-scrollbar {
        width: 5px;
    }

    ::-webkit-scrollbar-track {
        width: 5px;
        background: #f5f5f5;
    }

    ::-webkit-scrollbar-thumb {
        width: 1em;
        background-color: #ddd;
        outline: 1px solid slategrey;
        border-radius: 1rem;
    }

    .text-small {
        font-size: 0.9rem;
    }

    .messages-box,
    .chat-box {
        height: 510px;
        overflow-y: scroll;
    }

    .rounded-lg {
        border-radius: 0.5rem;
    }

    input::placeholder {
        font-size: 0.9rem;
        color: #999;
    }
</style>
<div class="container py-5 px-4">
    <!-- For demo purpose-->
    <header class="text-center col-lg-7">
        <h1>Your Messages</h1>
    </header>

    <div class="row rounded-lg overflow-hidden shadow">
        <!-- Chat Box-->
        <div class="col-lg-7 px-0">
            <div class="px-4 py-5 chat-box bg-white">
                <!-- Sender Message-->


                <?php foreach ($myMessage as $key => $row) {
                   
                ?>
                <!-- Reciever Message-->
                <div class="media w-100 mx-2 mb-3">
                    <div class="media-body">
                        <div class="bg-primary rounded py-2 px-3 mb-2">
                            <p class="text-small mb-0 text-white"><?= $row['message'] ?></p>
                        </div>
                        <p class="small text-muted"><?= $row['date'] ?></p>
                    </div>
                </div>
                <?php } ?>
               


            </div>
        </div>
    </div>
</div>

<?php include './includes/footer.php' ?>