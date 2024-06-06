<?php
ob_start();
require "../includes/header-admin.php";
require "../config.php";

if (isset($_POST['submit'])) {
    if (empty($_POST['name'])) {
        echo "<script> alert('one or more inputs are empty');</script>";
    } else {
        $name = $_POST['name'];
        if (isset($conn)) {
            $insert = $conn->prepare("INSERT INTO categories (name) VALUES(:name)");
        }
        $insert->execute([
            ":name" => $name,
        ]);
        header("location: show-category-admin.php");
    }
}
ob_end_flush();
?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="create-category-admin.php">
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name"/>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require "../includes/footer-admin.php"; ?>