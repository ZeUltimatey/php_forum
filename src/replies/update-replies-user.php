<?php
ob_start();
require "../includes/header.php";
require "../config.php";
//grapping the data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($conn)) {
        $select = $conn->query("SELECT * FROM replies_user WHERE id='$id' ");
    }
    $select->execute();
    $reply = $select->fetch(PDO::FETCH_OBJ);

    if ($reply->user_id !== $_SESSION['user_id']) {
        header("location: " . APPURL . " ");
    }
}
if (isset($_POST['submit'])) {
    if (empty($_POST['reply'])) {
        echo "<script> alert('one or more inputs are empty');</script>";
    } else {
        $reply = $_POST['reply'];
        $update = $conn->prepare("UPDATE replies_user SET reply = :reply WHERE id='$id' ");
        $update->execute([
            ":reply" => $reply,
        ]);
        header("location: " . APPURL . " ");
    }
}
ob_end_flush();
?>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="main-col">
                    <div class="block">
                        <h1 class="pull-left">Create A Reply</h1>
                        <h4 class="pull-right">A Simple Forum</h4>
                        <div class="clearfix"></div>
                        <hr>
                        <form role="form" method="POST" action="update-replies-user.php?id=<?php echo $id; ?>">
                            <div class="form-group">
                                <label>Reply</label>
                                <input type="text" value="<?php echo $reply->reply; ?> " class="form-control"
                                       name="reply"
                                       placeholder="Enter Reply">
                            </div>
                            <button type="submit" name="submit" class="color btn btn-default">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require "../includes/footer.php" ?>