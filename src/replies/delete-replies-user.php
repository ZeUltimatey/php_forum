<?php
ob_start();
require "../includes/header.php";
require "../config.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($conn)) {
        $select = $conn->prepare("SELECT * FROM replies_user WHERE id=:id");
        $select->execute([':id' => $id]);
        $reply = $select->fetch(PDO::FETCH_OBJ);
        if ($reply && $reply->user_id !== $_SESSION['user_id']) {
            header("location: " . APPURL . " ");
            exit;
        } else {
            $delete = $conn->prepare("DELETE FROM replies_user WHERE id=:id");
            $delete->execute([':id' => $id]);
            header("location: " . APPURL . " ");
            exit;
        }
    }
}
ob_end_flush();
require "../includes/footer.php";
?>