<?php
ob_start();
require "../includes/header-admin.php";
require "../config.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($conn)) {
        $category = $conn->query("SELECT * FROM categories WHERE id = '$id' ");
    }
    $category->execute();
    $singCategory = $category->fetch(PDO::FETCH_OBJ);
}

if (isset($_POST['submit'])) {
    if (empty($_POST['name'])) {
        echo "<script> alert('one or more inputs are empty');</script>";
    } else {
        $name = $_POST['name'];
        $update = $conn->prepare("UPDATE categories SET name = :name WHERE id='$id' ");
        $update->execute([
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
                    <h5 class="card-title mb-5 d-inline">Update categories</h5>
                    <form method="POST" action="update-category-admin.php?id=<?php echo $id; ?>">
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" value="<?php echo $singCategory->name; ?>" name="name" id="form2Example1"
                                   class="form-control" placeholder="name"/>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require "../includes/footer-admin.php"; ?>