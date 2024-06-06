<?php
ob_start();
require "../includes/header-admin.php";
require "../config.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($conn)) {
        $delete = $conn->query("DELETE FROM replies_user WHERE id = '$id' ");
    }
    $delete->execute();
    header("location: show-replies-admin.php");
}
ob_end_flush();
require "../includes/footer-admin.php";
?>