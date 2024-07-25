<?php if(isset($_SESSION['message'])): ?>
    <div class="col-lg-12 <?php echo $_SESSION['type']; ?>">
        <p class="h5">
            <?= $_SESSION['message'];
            unset($_SESSION['message']);
            unset($_SESSION['type']);
            ?>
        </p>
    </div>
<?php endif; ?>

