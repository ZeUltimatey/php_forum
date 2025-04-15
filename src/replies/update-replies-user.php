<?php
ob_start();
require "../includes/header.php";
require "../config.php";

if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Explicitly cast to integer to avoid non-numeric input

    // Use a prepared statement to retrieve the reply
    if (isset($conn)) {
        $select = $conn->prepare("SELECT * FROM replies_user WHERE id = :id");
        $select->execute([':id' => $id]);
        $reply = $select->fetch(PDO::FETCH_OBJ);

        // Verify user authorization
        if ($reply && $reply->user_id !== $_SESSION['user_id']) {
            header("location: " . APPURL . " ");
            exit;
        }
    }
}

// Handle form submission
if (isset($_POST['submit'])) {
    if (empty($_POST['reply'])) {
        echo "<script> alert('one or more inputs are empty');</script>";
    } else {
        // Ensure reply is a trimmed string, sanitized if needed
        $reply = (string) trim($_POST['reply']);

        // Update reply safely with a prepared statement
        $update = $conn->prepare("UPDATE replies_user SET reply = :reply WHERE id = :id");
        $update->bindParam(':reply', $reply, PDO::PARAM_STR);
        $update->bindParam(':id', $id, PDO::PARAM_INT);
        $update->execute();
        
        header("location: " . APPURL . " ");
        exit;
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
                    <form role="form" method="POST" action="update-replies-user.php?id=<?php echo htmlspecialchars($id); ?>">
                        <div class="form-group">
                            <label>Reply</label>
                            <input type="text" value="<?php echo htmlspecialchars($reply->reply); ?>" class="form-control" name="reply" placeholder="Enter Reply">
                        </div>
                        <button type="submit" name="submit" class="color btn btn-default">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "../includes/footer.php" ?>
