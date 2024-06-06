<?php
ob_start();
require "../includes/header-admin.php";
require "../config.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($conn)) {
        // Delete the replies-user associated with the topic
        $deleteReplies = $conn->query("DELETE FROM replies_user WHERE topic_id = '$id' ");
        $deleteReplies->execute();

        // Delete the topic
        $deleteTopic = $conn->query("DELETE FROM topics_user WHERE id = '$id' ");
        $deleteTopic->execute();
    }
    header("location: show-topic-admin.php");
}
ob_end_flush();
?>
<?php require "../includes/footer-admin.php"; ?>