<?php
ob_start();
require "../includes/header-admin.php";
require "../config.php";
if (isset($conn)) {
    $categories = $conn->query("SELECT * FROM categories ");
}
$categories->execute();
$allCategories = $categories->fetchALL(PDO::FETCH_OBJ);
ob_end_flush();
?>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <a href="<?php echo ADMINURL; ?>/categories/create-category-admin.php"
                           class="btn btn-primary mb-4 text-center float-right">Create categories</a>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Nr.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Update</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($allCategories as $category) : ?>
                                <tr>
                                    <th scope="row"><?php echo $category->id; ?></th>
                                    <td><?php echo $category->name; ?></td>
                                    <td><a href="update-category-admin.php?id=<?php echo $category->id; ?>"
                                           class="btn btn-warning text-white text-center ">Update</a></td>
                                    <td><a href="delete-category-admin.php?id=<?php echo $category->id; ?>"
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