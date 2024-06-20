<?php
require __DIR__ . "/includes/header.php";
require __DIR__ . "/config.php";

// Check if database connection is established
if (isset($conn)) {
    // Fetch all topics with their respective reply count
    $stmt = $conn->query("SELECT topics_user.id AS id,
                         topics_user.title AS title,
                         topics_user.category AS category,
                         topics_user.user_name AS user_name,
                         topics_user.user_image AS user_image,
                         topics_user.created_at AS created_at,
                         COUNT(replies_user.topic_id) AS count_replies 
                         FROM topics_user 
                         LEFT JOIN replies_user 
                         ON topics_user.id = replies_user.topic_id 
                         GROUP BY topics_user.id, topics_user.title, topics_user.category, 
                         topics_user.user_name, topics_user.user_image, topics_user.created_at");
    $allTopics = $stmt->fetchAll(PDO::FETCH_OBJ);
} else {
    echo "Database connection not established.";
    exit;
}

// Fetch forum statistics
if (isset($conn)) {
    // Count total number of topics
    $topics = $conn->query("SELECT COUNT(*) AS all_topics FROM topics_user");
    $topics->execute();
    $allTopicsCount = $topics->fetch(PDO::FETCH_OBJ);

    // Count number of posts inside every category
    $categories = $conn->query("SELECT categories.id AS id, categories.name AS name,
                                COUNT(topics_user.category) AS count_category 
                                FROM categories 
                                LEFT JOIN topics_user 
                                ON categories.name = topics_user.category 
                                GROUP BY categories.id, categories.name;");
    $categories->execute();
    $allCategories = $categories->fetchAll(PDO::FETCH_OBJ);

    // Count main-users, topics, and categories
    $users = $conn->query("SELECT COUNT(*) AS count_users FROM users");
    $users->execute();
    $allUsers = $users->fetch(PDO::FETCH_OBJ);

    $topics = $conn->query("SELECT COUNT(*) AS count_topics FROM topics_user");
    $topics->execute();
    $allTopics_count = $topics->fetch(PDO::FETCH_OBJ);

    $categories_count = $conn->query("SELECT COUNT(*) AS categories_count FROM categories");
    $categories_count->execute();
    $allCategories_count = $categories_count->fetch(PDO::FETCH_OBJ);
} else {
    echo "Database connection not established.";
    exit;
}

$sortOption = $_GET['sort'] ?? 'date_desc';

switch ($sortOption) {
    case 'title_asc':
        $orderBy = 'topics_user.title ASC';
        break;
    case 'title_desc':
        $orderBy = 'topics_user.title DESC';
        break;
    case 'date_asc':
        $orderBy = 'topics_user.created_at ASC';
        break;
    case 'date_desc':
    default:
        $orderBy = 'topics_user.created_at DESC';
        break;
}

// Fetch topics based on search or sort option
// Fetch topics based on search or sort option
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $topics = $conn->prepare("SELECT * FROM topics_user WHERE title LIKE :search ORDER BY $orderBy");
    $topics->execute(['search' => "%$search%"]);
    $results = $topics->fetchAll(PDO::FETCH_OBJ);
} else {
    $stmt = $conn->query("SELECT topics_user.id AS id,
                         topics_user.title AS title,
                         topics_user.category AS category,
                         topics_user.user_name AS user_name,
                         topics_user.user_image AS user_image,
                         topics_user.created_at AS created_at,
                         COUNT(replies_user.topic_id) AS count_replies
                         FROM topics_user
                         LEFT JOIN replies_user
                         ON topics_user.id = replies_user.topic_id
                         GROUP BY topics_user.id, topics_user.title, topics_user.category,
                         topics_user.user_name, topics_user.user_image, topics_user.created_at
                         ORDER BY $orderBy");

    $allTopics = $stmt->fetchAll(PDO::FETCH_OBJ);
}
?>
<div class="container">
    <div class="row">
        <h1 class="pull-center">Welcome to Forum</h1>
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <div class="sort-options dropdown">
                        <form action="index-user.php" method="get">
                            <input type="text" name="search" placeholder="Search topics">
                            <input type="submit" value="Search">
                        </form>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Sort Options <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="?sort=title_asc">Sort by Title (A-Z)</a></li>
                            <li><a href="?sort=title_desc">Sort by Title (Z-A)</a></li>
                            <li><a href="?sort=date_asc">Sort by Date (Oldest First)</a></li>
                            <li><a href="?sort=date_desc">Sort by Date (Newest First)</a></li>
                        </ul>
                    </div>
                    <ul id="topics">
    <?php if (isset($results)) {
        foreach ($results as $result) : ?>
            <li class="topic">
                <div class="row">
                    <div class="col-md-2">
                        <img class="avatar pull-left" src="img/<?php echo $result->user_image; ?>"/>
                    </div>
                    <div class="col-md-10">
                        <div class="topic-content pull-lefts">
                            <h4>
                                <a href="<?php echo APPURL; ?>/topics/show-topic-user.php?id=<?php echo $result->id; ?>">
                                    <?php 
                                    $title = $result->title;
                                    $wrappedTitle = wordwrap($title, 25, "\n", true);
                                    $displayTitle = str_replace("\n", '<br>', $wrappedTitle);
                                    echo $displayTitle; 
                                    ?>
                                </a>
                            </h4>
                            <div class="topic-info">
                                <a href="<?php echo APPURL; ?>/categories/show.php?name=<?php echo $result->category; ?>"><?php echo $result->category; ?></a>
                                >>
                                <a href="<?php echo APPURL; ?>/main/user.php?name=<?php echo $result->user_name; ?>">
                                    <?php echo $result->user_name; ?></a>
                                >> Posted on: <?php echo $result->created_at; ?>
                                <span class="color badge pull-right"><?php echo property_exists($result, 'count_replies') ? $result->count_replies : 0; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach;
    } else {
        foreach ($allTopics as $topic) : ?>
            <li class="topic">
                <div class="row">
                    <div class="col-md-2">
                        <img class="avatar pull-left" src="img/<?php echo $topic->user_image; ?>"/>
                    </div>
                    <div class="col-md-8">
                        <div class="topic-content pull-right">
                            <h4>
                                <a href="<?php echo APPURL; ?>/topics/show-topic-user.php?id=<?php echo $topic->id; ?>">
                                    <?php 
                                    $title = $topic->title;
                                    $wrappedTitle = wordwrap($title, 25, "\n", true);
                                    $displayTitle = str_replace("\n", '<br>', $wrappedTitle);
                                    echo $displayTitle; 
                                    ?>
                                </a>
                            </h4>
                            <div class="topic-info">
                                <a href="<?php echo APPURL; ?>/categories/show-category-user.php?name=<?php echo $topic->category; ?>"><?php echo $topic->category; ?></a>
                                >>
                                <a href="<?php echo APPURL; ?>/main/user.php?name=<?php echo $topic->user_name; ?>">
                                    <?php echo $topic->user_name; ?></a>
                                >> Posted on: <?php echo $topic->created_at; ?>
                                <span class="color badge pull-right"><?php echo $topic->count_replies; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach;
    }
    ?>
</ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="sidebar">
                <div class="block">
                    <h3>Categories</h3>
                    <div class="list-group">
                        <a href="#" class="list-group-item">All Topics <span
                                    class="badge pull-right"><?php echo $allTopicsCount->all_topics; ?></span></a>
                        <?php foreach ($allCategories as $category) : ?>
                            <a href="<?php echo APPURL; ?>/categories/show-category-user.php?name=<?php echo $category->name; ?>"
                               class="list-group-item"><?php echo $category->name; ?> <span
                                        class="badge pull-right"><?php echo $category->count_category; ?></span></a> <?php endforeach; ?>
                    </div>
                </div>
                <div class="block" style="margin-top: 20px;">
                    <h3 class="margin-top: 40px">Forum Statistics</h3>
                    <div class="list-group">
                        <a class="list-group-item">Total Number of Users:<span
                                    class="color badge pull-right"><?php echo $allUsers->count_users; ?></span></a>
                        <a class="list-group-item">Total Number of Topics:<span
                                    class="color badge pull-right"><?php echo $allTopics_count->count_topics; ?></span></a>
                        <a class="list-group-item">Total Number of Categories: <span
                                    class="color badge pull-right"><?php echo $allCategories_count->categories_count; ?></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "includes/footer.php"; ?>

