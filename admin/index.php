<?php
include "./constants.php";
include './adminControllers/users.php';
include './adminIncludes/header.php';
include './adminIncludes/sidebar.php';

function prepare_sql($sql)
{
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result();
    return $records;
}


$sql1_row = "SELECT * FROM books";
$row1_record = prepare_sql($sql1_row);
$nr1_of_rows = $row1_record->num_rows; 

$sql2_row = "SELECT * FROM borrow WHERE is_borrow = 0";
$row2_record = prepare_sql($sql2_row);
$nr2_of_rows = $row2_record->num_rows;

$sql3_row = "SELECT * FROM borrow WHERE returned = 1";
$row3_record = prepare_sql($sql3_row);
$nr3_of_rows = $row3_record->num_rows;

$sql4_row = "SELECT * FROM users";
$row4_record = prepare_sql($sql4_row);
$nr4_of_rows = $row4_record->num_rows;

?>
            
            <main class="main-content col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <?php include './adminIncludes/topnav.php' ?>
                <section id="dashboard" class="section">
                    <h2>Dashboard</h2>
                    <div class="stats">
                        <div class="stat-item">
                            <span class="stat-value"><?= $nr1_of_rows ?></span>
                            <span class="stat-label">Available Book</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value"><?= $nr2_of_rows ?></span>
                            <span class="stat-label">Books Issued</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value"><?= $nr3_of_rows ?></span>
                            <span class="stat-label">Returned Books</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value"><?= $nr4_of_rows ?></span>
                            <span class="stat-label">Active Users</span>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>
    <?php include './adminIncludes/footer.php' ?>
