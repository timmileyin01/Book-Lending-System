<?php
include "./admin/constants.php";
include './admin/adminControllers/books.php';
include './includes/header.php';
?>
<div class="container my-5">
<center><?php include './admin/adminIncludes/messages.php' ?></center>
  <div class="row">
    <div class="col-sm-4">
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="#">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./catalog.php">Search for a Book</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./catalog.php">Borrow a Book</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./borrowindex.php">Generate Evidence of Lending</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./borrowindex.php">Return Book</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./notification.php">Messages</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./history.php">History</a>
        </li>
      </ul>
    </div>
    <div class="col-sm-8">
      <?php if (isset($_SESSION['book_user_id'])){
        $user = selectOne('users', ['user_id' => $_SESSION['book_user_id']]);
      } ?>
      <p class="h6"><span class="h5 text-primary">Name: </span> <?= $user['firstname'] . ' ' . $user['lastname'] ?></p>
      <p class="h6"><span class="h5 text-primary">ID Number: </span> <?= $user['id_number']?></p>
      <p class="h6"><span class="h5 text-primary">Email: </span> <?= $user['email'] ?></p>
      <p class="h6"><span class="h5 text-primary">User Role: </span> <?= $user['user_role'] ?></p>
      <div class="col-lg-18">
        <form action="edit-profile.php" method="post">
          <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
          <input type="submit" value="Edit" name="edit-account" class="btn btn-success">
        </form>
      </div>
      
      </div>
  </div>
</div> 
    
<?php include './includes/footer.php' ?>
