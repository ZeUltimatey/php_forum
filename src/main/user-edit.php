<?php
ob_start();
require "../includes/header.php";
require "../config.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($conn)) {
        $select = $conn->query("SELECT * FROM users WHERE id='$id' ");
    }
    $select->execute();
    $user = $select->fetch(PDO::FETCH_OBJ);

    if ($user->id !== $_SESSION['user_id']) {
        header("location: " . APPURL . " ");
    }
}
if (isset($_POST['submit'])) {
    if (empty($_POST['email']) or empty($_POST['about'])) {
        echo "<script> alert('one or more inputs are empty');</script>";
    } else {
        $email = $_POST['email'];
        $about = $_POST['about'];
        $update = $conn->prepare("UPDATE users SET email = :email, about = :about WHERE id='$id'");
        $update->execute([
            ":email" => $email,
            ":about" => $about,
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
                    <h1 class="pull-left">Edit User Information</h1>
                    <div class="clearfix"></div>
                    <hr>
                    <form role="form" method="POST" action="user-edit.php?id= <?php echo $id; ?>">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" value="<?php echo $user->email; ?> " class="form-control" name="email"
                                   placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label>About</label>
                            <textarea id="body" rows="10" cols="80" class="form-control"
                                      name="about"><?php echo $user->about; ?></textarea>
                            <script>
                                CKEDITOR.replace('body');
                            </script>
                        </div>
                        <button type="submit" name="submit" class="color btn btn-default">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "../includes/footer.php"; ?>
