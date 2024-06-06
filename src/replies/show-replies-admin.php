<?php
ob_start();
require "../includes/header-admin.php";
require "../config.php";
if (isset($conn)) {
    $replies = $conn->query("SELECT * FROM replies_user");
    $allReplies = $replies->fetchAll(PDO::FETCH_OBJ);
    $result = $conn->query("SELECT * FROM topics_user WHERE id");
}

if ($result !== false) {
    $topic = $result->fetch(PDO::FETCH_OBJ);
    if ($topic !== false) {
    } else {
        echo "No topic found with the given id.";
    }
} else {
    echo "Database query failed.";
}
ob_end_flush();
?>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Nr.</th>
                                <th scope="col">Reply</th>
                                <th scope="col">User name</th>
                                <th scope="col">Go to reply</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($allReplies as $reply) : ?>
                                <tr>
                                    <th scope="row"><?php echo $reply->id; ?></th>
                                    <td><?php echo $reply->reply; ?></td>
                                    <td><?php echo $reply->user_name; ?></td>
                                    <td>
                                        <a href="http://localhost:8080/topics/show-topic-user.php?id=<?php echo $reply->topic_id; ?>"
                                           class="btn btn-success text-center ">Go to reply</a></td>
                                    <td><a href="delete-replies-admin.php?id=<?php echo $reply->id; ?>"
                                           class="btn btn-danger  text-center ">Delete</a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require "../includes/footer-admin.php"; ?>