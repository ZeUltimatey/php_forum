<?php
ob_start();
require "../includes/header.php";
require "../config.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($conn)) {
        $topic = $conn->query("SELECT * FROM topics_user WHERE id='$id' ");
    }
    $topic->execute();
    $singleTopic = $topic->fetch(PDO::FETCH_OBJ);

    $topicCount = $conn->query("SELECT COUNT(*) AS count_topics FROM topics_user WHERE user_name= '$singleTopic->user_name' ");
    $topicCount->execute();
    $count = $topicCount->fetch(PDO::FETCH_OBJ);

    $reply = $conn->query("SELECT * FROM replies_user WHERE topic_id='$id' ");
    $reply->execute();
    $allReplies = $reply->fetchAll(PDO::FETCH_OBJ);
} else {
    header("location: " . APPURL . "/404.php");
}
if (isset($_POST['submit'])) {
    if (empty($_POST['reply'])) {
        echo "<script> alert('one or more inputs are empty');</script>";
    } else {
        $reply = $_POST['reply'];
        $user_id = $_SESSION['user_id'];
        $user_image = $_SESSION['user_image'];
        $topic_id = $id;
        $user_name = $_SESSION['username'];
        $insert = $conn->prepare("INSERT INTO replies_user (reply, user_id, user_image, topic_id, user_name) 
			VALUES(:reply, :user_id, :user_image, :topic_id, :user_name)");
        $insert->execute([
            ":reply" => $reply,
            ":user_id" => $user_id,
            ":user_image" => $user_image,
            ":topic_id" => $topic_id,
            ":user_name" => $user_name,
        ]);
        header("location: " . APPURL . "/topics/show-topic-user.php?id=" . $id . " ");
    }
}
ob_end_flush();
?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const elements = document.querySelectorAll('.topic-content h4, .topic-info');

    elements.forEach(el => {
        // Check if the element already has a span to avoid re-processing
        if (el.querySelector('span') === null) {
            let textContent = el.textContent.trim();

            if (textContent.length > 15) {
                let firstPart = textContent.substr(0, 15);
                let secondPart = textContent.substr(15);

                // Clear the current text content
                el.textContent = '';

                // Create and append the first part
                let firstTextNode = document.createTextNode(firstPart);
                el.appendChild(firstTextNode);

                // Create, configure, and append the span for the second part
                let span = document.createElement('span');
                span.textContent = secondPart;
                el.appendChild(span);
            }
        }
    });
});
</script>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left"><?php echo $singleTopic->title; ?></h1>
                    <div class="clearfix"></div>
                    <ul id="topics">
                        <li id="main-topic" class="topic topic">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="user-info">
                                        <img class="avatar pull-left"
                                             src="../img/<?php echo $singleTopic->user_image; ?>"/>
                                        <ul>
                                            <li><strong><?php echo $singleTopic->user_name; ?></strong></li>
                                            <li><?php echo $count->count_topics; ?></li>
                                            <li>
                                                <a href="<?php echo APPURL; ?>/main/user.php?name=<?php echo $singleTopic->user_name; ?>">Profile</a>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="topic-content pull-left">
                                        <p><?php echo $singleTopic->body; ?></p>
                                    </div>
                                    <?php if (isset($_SESSION['username'])) : ?>
                                        <?php if ($singleTopic->user_name == $_SESSION['username']) : ?>
                                            <a class="btn btn-danger"
                                               href="delete-topic-user.php?id=<?php echo $singleTopic->id; ?>"
                                               role="button">Delete</a>
                                            <a class="btn btn-warning"
                                               href="update-topic-user.php?id=<?php echo $singleTopic->id; ?>"
                                               role="button">update</a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                        <?php foreach ($allReplies as $reply) : ?>
                            <li class="topic topic">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="user-info">
                                            <img class="avatar pull-left"
                                                 src="../img/<?php echo $reply->user_image; ?>"/>
                                            <ul>
                                                <li><strong><?php echo $reply->user_name; ?></strong></li>
                                                <li>
                                                    <a href="<?php echo APPURL; ?>/main/user.php?name=<?php echo $singleTopic->user_name; ?>">Profile</a>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="topic-content pull-left">
                                            <p><?php echo $reply->reply; ?></p>
                                        </div>
                                    </div>
                                    <?php if (isset($_SESSION['username'])) : ?>
                                        <?php if ($reply->user_id == $_SESSION['user_id']) : ?>
                                            <a class="btn btn-danger"
                                               href="../replies/delete-replies-user.php?id=<?php echo $reply->id; ?>"
                                               role="button">Delete</a>
                                            <a class="btn btn-warning"
                                               href="../replies/update-replies-user.php?id=<?php echo $reply->id; ?>"
                                               role="button">update</a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <h3>Reply To Topic</h3>
                    <form role="form" method="POST" action="show-topic-user.php?id=<?php echo $id; ?>">
                        <div class="form-group">
                            <textarea id="reply" rows="10" cols="80" class="form-control" name="reply"></textarea>
                            <script>
                                CKEDITOR.replace('reply');
                            </script>
                        </div>
                        <button type="submit" name="submit" class="color btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "../includes/footer.php" ?>
