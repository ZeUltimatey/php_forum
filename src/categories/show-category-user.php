<?php
ob_start();
require "../includes/header.php";
require "../config.php";

$sortOption = $_GET['sort'] ?? 'date_desc';

switch ($sortOption) {
    case 'title_asc':
        $orderBy = 'title ASC';
        break;
    case 'title_desc':
        $orderBy = 'title DESC';
        break;
    case 'date_asc':
        $orderBy = 'created_at ASC';
        break;
    case 'date_desc':
    default:
        $orderBy = 'created_at DESC';
        break;
}

$allTopics = [];

if (isset($_GET['name'])) {
    $name = $_GET['name'];
    if (isset($conn)) {
        $topics = $conn->prepare("SELECT topics_user.id AS id,
                                  topics_user.title AS title,
                                  topics_user.category AS category,
                                  topics_user.user_name AS user_name,
                                  topics_user.user_image AS user_image,
                                  topics_user.created_at AS created_at,
                                  COUNT(replies_user.topic_id) AS count_replies
                                  FROM topics_user
                                  LEFT JOIN replies_user
                                  ON topics_user.id = replies_user.topic_id
                                  WHERE category = :name
                                  GROUP BY topics_user.id, topics_user.title, topics_user.category,
                                  topics_user.user_name, topics_user.user_image, topics_user.created_at
                                  ORDER BY $orderBy");
        $topics->bindParam(':name', $name);
        $topics->execute();
        if ($topics->errorCode() != 0) {
            $errors = $topics->errorInfo();
            echo("SQL error: " . $errors[2]);
        } else {
            $allTopics = $topics->fetchAll(PDO::FETCH_OBJ);
        }
    }
}

if (isset($conn)) {
    $topics = $conn->query("SELECT COUNT(*) AS all_topics FROM topics_user");
    $topics->execute();
    $allTopicsCount = $topics->fetch(PDO::FETCH_OBJ);
    //number of posts inside every category
    $categories = $conn->query("SELECT categories.id AS id, categories.name AS name,
        COUNT(topics_user.category) AS count_category FROM categories LEFT JOIN topics_user ON
        categories.name = topics_user.category GROUP BY categories.id, categories.name;");
    $categories->execute();
    $allCategories = $categories->fetchAll(PDO::FETCH_OBJ);
    //forum statistics
    ///count main-users
    $users = $conn->query(" SELECT COUNT(*) AS count_users FROM users");
    $users->execute();
    $allUsers = $users->fetch(PDO::FETCH_OBJ);
    ///count topics
    $topics = $conn->query(" SELECT COUNT(*) AS count_topics FROM topics_user");
    $topics->execute();
    $allTopics_count = $topics->fetch(PDO::FETCH_OBJ);
    ///count categories-user
    $categories_count = $conn->query(" SELECT COUNT(*) AS categories_count FROM categories");
    $categories_count->execute();
    $allCategories_count = $categories_count->fetch(PDO::FETCH_OBJ);
} else {
    echo "Database connection not established.";
    exit;
}

ob_end_flush();
?>
<div class="container">
    <div class="row">
        <h1 class="pull-center">Welcome to Forum</h1>
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <div class="sort-options dropdown">
                        <form action="show-category-user.php" method="get">
                            <input type="hidden" name="name" value="<?php echo $_GET['name']; ?>">
                            <input type="text" name="search" placeholder="Search topics">
                            <input type="submit" value="Search">
                        </form>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Sort Options <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="?name=<?php echo $_GET['name']; ?>&sort=title_asc">Sort by Title (A-Z)</a></li>
                            <li><a href="?name=<?php echo $_GET['name']; ?>&sort=title_desc">Sort by Title (Z-A)</a>
                            </li>
                            <li><a href="?name=<?php echo $_GET['name']; ?>&sort=date_asc">Sort by Date (Oldest
                                    First)</a></li>
                            <li><a href="?name=<?php echo $_GET['name']; ?>&sort=date_desc">Sort by Date (Newest
                                    First)</a></li>
                        </ul>
                    </div>
                    <ul id="topics">
                        <?php foreach ($allTopics as $topic) : ?>
                            <li class="topic">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img class="avatar pull-left" src="../img/<?php echo $topic->user_image; ?>"/>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="topic-content pull-right">
                                            <h3>
                                                <a href="../topics/show-topic-user.php?id=<?php echo $topic->id; ?>"><?php echo $topic->title; ?></a>
                                            </h3>
                                            <div class="topic-info">
                                                <a href="<?php echo APPURL; ?>/categories/show-category-user.php?name=<?php echo $topic->category; ?>"><?php echo $topic->category; ?></a>
                                                >>
                                                <a href="<?php echo APPURL; ?>/main/user.php?name=<?php echo $topic->user_name; ?>"><?php echo $topic->user_name; ?></a>
                                                >> Posted on: <?php echo $topic->created_at; ?>
                                                <span class="color badge pull-right"><?php echo property_exists($topic, 'count_replies') ? $topic->count_replies : 0; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="sidebar">
                <div class="block">
                    <h3>Categories</h3>
                    <div class="list-group">
                        <a href="<?php echo APPURL; ?>/index-user.php" class="list-group-item active">All Topics <span
                                    class="badge pull-right"><?php echo $allTopicsCount->all_topics; ?></span></a>
                        <?php foreach ($allCategories as $category) : ?>
                            <a href="<?php echo APPURL; ?>/categories/show-category-user.php?name=<?php echo $category->name; ?>"
                               class="list-group-item"><?php echo $category->name; ?><span
                                        class="color badge pull-right"><?php echo $category->count_category; ?></span></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="block"
                ">
                <h3 class="margin-top: 40px">Forum Statistics</h3>
                <div class="list-group">
                    <a href="#" class="list-group-item">Total Number of Users:<span
                                class="color badge pull-right"><?php echo $allUsers->count_users; ?></span></a>
                    <a href="#" class="list-group-item">Total Number of Topics:<span
                                class="color badge pull-right"><?php echo $allTopics_count->count_topics; ?></span></a>
                    <a href="#" class="list-group-item">Total Number of Categories: <span
                                class="color badge pull-right"><?php echo $allCategories_count->categories_count; ?></span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "../includes/footer.php"; ?>
