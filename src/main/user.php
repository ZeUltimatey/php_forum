<?php
ob_start();
require "../includes/header.php";
require "../config.php";
if (isset($_GET['name'])) {
    $name = $_GET['name'];
    if (isset($conn)) {
        $select = $conn->query("SELECT * FROM users WHERE username='$name' ");
    }
    $select->execute();
    $user = $select->fetch(PDO::FETCH_OBJ);

    $num_topics = $conn->query("SELECT COUNT(*) AS num_topics FROM topics_user WHERE user_name='$name' ");
    $num_topics->execute();
    $all_num_topics = $num_topics->fetch(PDO::FETCH_OBJ);

    $num_replies = $conn->query("SELECT COUNT(*) AS num_replies FROM replies_user WHERE user_name='$name' ");
    $num_replies->execute();
    $all_num_replies = $num_replies->fetch(PDO::FETCH_OBJ);
}
ob_end_flush();
?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="user-info">
                <img class="avatar" src="../img/<?php echo $user->avatar; ?>"/>
                <h3 class="text-center"><?php echo $user->username; ?></h3>
            </div>
        </div>
        <div class="col-md-8">
            <div class="block">
                <h2>About</h2>
                <p><?php echo $user->about; ?></p>
                <p>Number of Topics: <?php echo $all_num_topics->num_topics; ?></p>
                <p>Number of Replies: <?php echo $all_num_replies->num_replies; ?></p>
            </div>
        </div>
    </div>
</div>
<?php require "../includes/footer.php"; ?>
