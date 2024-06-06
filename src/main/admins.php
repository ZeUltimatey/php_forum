<?php
ob_start();
require "../includes/header-admin.php";
require "../config.php";
if (isset($conn)) {
    $admins = $conn->query("SELECT * FROM admins ");
}
$admins->execute();
$allAdmins = $admins->fetchALL(PDO::FETCH_OBJ);
ob_end_flush();
?>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <a href="<?php echo ADMINURL; ?>/main/register-admins.php"
                           class="btn btn-primary mb-4 text-center float-right">Create admins</a>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Nr.</th>
                                <th scope="col">Admin name</th>
                                <th scope="col">Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($allAdmins as $admins) : ?>
                                <tr>
                                    <th scope="row"><?php echo $admins->id; ?></th>
                                    <td><?php echo $admins->adminname; ?></td>
                                    <td><?php echo $admins->email; ?></td>
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