<?php
ob_start();
require __DIR__ . "/includes/header-admin.php";
require "config.php";

//count_users
if (isset($conn)) {
    $users = $conn->query("SELECT COUNT(*) AS count_users FROM users");
}
$users->execute();
$allUsers = $users->fetch(PDO::FETCH_OBJ);
//count_topics
if (isset($conn)) {
    $topics = $conn->query("SELECT COUNT(*) AS count_topics FROM topics_user");
}
$topics->execute();
$allTopics = $topics->fetch(PDO::FETCH_OBJ);
//count_categories
if (isset($conn)) {
    $categories = $conn->query("SELECT COUNT(*) AS count_categories FROM categories");
}
$categories->execute();
$allCategories = $categories->fetch(PDO::FETCH_OBJ);
//count_admins
if (isset($conn)) {
    $admins = $conn->query("SELECT COUNT(*) AS count_admins FROM admins");
}
$admins->execute();
$allAdmins = $admins->fetch(PDO::FETCH_OBJ);
//count_replies
if (isset($conn)) {
    $replies = $conn->query("SELECT COUNT(*) AS count_replies FROM replies_user");
}
$replies->execute();
$allReplies = $replies->fetch(PDO::FETCH_OBJ);
ob_end_flush();
?>
    <!DOCTYPE html>
    <style>
        .block {
            background: var(--color-block-background-light);
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px;
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
            overflow-wrap: break-word;
            word-wrap: break-word;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-2">
                <div class="block">
                    <h3>Users</h3>
                    <p>Number of users: <?php echo $allUsers->count_users; ?></p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="block">
                    <h3>Topics</h3>
                    <p>number of topics: <?php echo $allTopics->count_topics; ?></p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="block">
                    <h3>Categories</h3>
                    <p>Number of categories: <?php echo $allCategories->count_categories; ?></p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="block">
                    <h3>Admins</h3>
                    <p>Number of admins: <?php echo $allAdmins->count_admins; ?></p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="block">
                    <h3>Replies</h3>
                    <p>Number of replies:<?php echo $allReplies->count_replies; ?> </p>
                </div>
            </div>
        </div>
    </div>
<?php require "includes/footer-admin.php"; ?>