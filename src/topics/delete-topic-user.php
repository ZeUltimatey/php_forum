<?php
ob_start();
require "../includes/header.php";
require "../config.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($conn)) {
        $select = $conn->query("SELECT * FROM topics_user WHERE id='$id' ");
    }
    $select->execute();
    $topic = $select->fetch(PDO::FETCH_OBJ);
    if ($topic->user_name !== $_SESSION['username']) {
        header("location: " . APPURL . " ");
    } else {
        $delete = $conn->query("DELETE  FROM topics_user WHERE id='$id' ");
        $delete->execute();
        header("location: ../index-user.php");
    }
}
ob_end_flush();
?>
