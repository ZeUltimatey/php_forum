<?php
ob_start();
require "../includes/header-admin.php";
require "../config.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($conn)) {
        $delete = $conn->query("DELETE FROM categories WHERE id = '$id' ");
    }
    $delete->execute();
    header("location: show-category-admin.php");
}
ob_end_flush();
?>
