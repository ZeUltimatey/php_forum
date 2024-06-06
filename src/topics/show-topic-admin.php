<?php
ob_start();
require "../includes/header-admin.php";
require "../config.php";
if (isset($conn)) {
    $topics = $conn->query("SELECT * FROM topics_user ");
}
$topics->execute();
$allTopics = $topics->fetchALL(PDO::FETCH_OBJ);
ob_end_flush();
?>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table class="table mt-4">
                            <thead>
                            <tr>
                                <th scope="col">Nr.</th>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">User</th>
                                <th scope="col">Go to topic</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($allTopics as $topics) : ?>
                                <tr>
                                    <th scope="row"><?php echo $topics->id; ?></th>
                                    <td><?php echo $topics->title; ?></td>
                                    <td><?php echo $topics->category; ?></td>
                                    <td><?php echo $topics->user_name; ?></td>
                                    <td>
                                        <a href="http://localhost:8080/topics/show-topic-user.php?id=<?php echo $topics->id; ?>"
                                           class="btn btn-success text-center ">Go to topic</a></td>
                                    <td><a href="delete-topic-admin.php?id=<?php echo $topics->id; ?>"
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