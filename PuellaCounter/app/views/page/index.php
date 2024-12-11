<?php
session_start();
if ($_SESSION['userName'] == "") {
    header("Location: ../../../index.php");
    exit();
}
 
include '../template/header.php'; ?>

<?php include '../template/footer.php'; ?>