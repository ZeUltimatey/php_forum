<?php
ob_start();
require "../includes/header-admin.php";
require "../config.php";

if (isset($_POST['submit'])) {
    if (empty($_POST['adminname']) or empty($_POST['email']) or empty($_POST['password'])) {
        echo "<script> alert('one or more inputs are empty');</script>";
    } else {
        $adminname = $_POST['adminname'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if (isset($conn)) {
            $insert = $conn->prepare("INSERT INTO admins (adminname, email, password) VALUES(:adminname, :email, :password)");
        }
        $insert->execute([
            ":adminname" => $adminname,
            ":email" => $email,
            ":password" => $password,
        ]);
        header("location: admins.php");
    }
}
ob_end_flush();
?>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-5 d-inline">Create admins</h5>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-outline mb-4 mt-4">
                                <input type="text" name="adminname" id="form2Example1" class="form-control"
                                       placeholder="admin name"/>
                            </div>
                            <div class="form-outline mb-4 ">
                                <input type="email" name="email" id="form2Example1" class="form-control"
                                       placeholder="email"/>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" name="password" id="form2Example1" class="form-control"
                                       placeholder="password"/>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require "../includes/footer-admin.php"; ?>