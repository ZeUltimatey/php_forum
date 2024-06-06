<?php
ob_start();
require "../includes/header-admin.php";
require "../config.php";
if (isset($_POST['submit'])) {
    if (empty($_POST['email']) or empty($_POST['password'])) {
        echo "<script> alert('one or more inputs are empty');</script>";
    } else {
        //Get the data
        $email = $_POST['email'];
        $password = $_POST['password'];
        //Write the query
        if (isset($conn)) {
            $login = $conn->query("SELECT * FROM admins WHERE email = '$email' ");
        }
        $login->execute();
        $fetch = $login->fetch(PDO::FETCH_ASSOC);
        if ($login->rowCount() > 0) {
            if (password_verify($password, $fetch['password'])) {
                $_SESSION['adminname'] = $fetch['adminname'];
                $_SESSION['email'] = $fetch['email'];
                header("location: " . ADMINURL . "/index-admin.php");
            } else {
                echo "<script> alert('email or password is wrong');</script>";
            }
        }
    }
}
ob_end_flush();
?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mt-5">Login</h5>
                    <form method="POST" class="p-auto" action="login-admins.php">
                        <div class="form-outline mb-4"><input type="email" name="email" id="form2Example1"
                                                              class="form-control" placeholder="Email"
                                                              value="admin@gmail.com"/></div>
                        <div class="form-outline mb-4"><input type="password" name="password" id="form2Example2"
                                                              placeholder="Password" class="form-control"
                                                              value="123456"/>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "../includes/footer-admin.php"; ?>
