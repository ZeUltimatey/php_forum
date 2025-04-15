<?php
ob_start();
require "../includes/header.php";
require "../config.php";
if (isset($_POST['submit'])) {
    if (empty($_POST['title']) or empty($_POST['category']) or empty($_POST['body'])) {
        echo "<script> alert('one or more inputs are empty');</script>";
    } else {
        $title = $_POST['title'];
        $category = $_POST['category'];
        $body = $_POST['body'];
        $user_name = $_SESSION['name'];
        $user_image = $_SESSION['user_image'];
        if (isset($conn)) {
            $insert = $conn->prepare("INSERT INTO topics_user (title, category, body, user_name, user_image) VALUES(:title, :category, :body, :user_name, :user_image)");
        }
        $insert->execute([
            ":title" => $title,
            ":category" => $category,
            ":body" => $body,
            ":user_name" => $user_name,
            ":user_image" => $user_image,
        ]);
        header("location: " . APPURL . "/index-user.php");
    }
}
//grapping categories-user
$categories_select = $conn->query("SELECT * FROM categories ");
$categories_select->execute();
$allCats = $categories_select->fetchAll(PDO::FETCH_OBJ);
ob_end_flush();
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left">Create A Topic</h1>
                    <div class="clearfix"></div>
                    <hr>
                    <form role="form" method="POST" action="create-topic-user.php">
                        <div class="form-group">
                            <label>Topic Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Post Title">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" class="form-control">
                                <?php foreach ($allCats as $cat) : ?>
                                    <option value="<?php echo $cat->name; ?>"><?php echo $cat->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Topic Body</label>
                            <textarea id="body" rows="10" cols="80" class="form-control" name="body"></textarea>
                            <script>
                                CKEDITOR.replace('body');
                            </script>
                        </div>
                        <button type="submit" name="submit" class="color btn btn-default">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "../includes/footer.php" ?>
