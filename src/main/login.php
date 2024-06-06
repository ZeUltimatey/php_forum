<?php
ob_start();
require "../includes/header.php";
require "../config.php";
if (isset($_POST['submit'])) {
    if (empty($_POST['email']) or empty($_POST['password'])) {
        echo "<script> alert('one or more inputs are empty');</script>";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (isset($conn)) {
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);
        } else {
            echo "Database connection not established.";
            exit;
        }
        if ($user) {
            if (password_verify($password, $user->password)) {
                $_SESSION['username'] = $user->username;
                $_SESSION['name'] = $user->name;
                $_SESSION['user_id'] = $user->id;
                $_SESSION['email'] = $user->email;
                $_SESSION['user_image'] = $user->avatar;
                header("location: " . APPURL . "/index-user.php");
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
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left">Login</h1>
                    <div class="clearfix"></div>
                    <hr>
                    <form role="form" method="post" action="login.php">
                        <div class="form-group"><label>Email Address*</label> <input type="email" class="form-control"
                                                                                     name="email"
                                                                                     placeholder="Enter Your Email Address"
                                                                                     value="tiendung8a6@gmail.com">
                        </div>
                        <div class="form-group"><label>Password*</label> <input type="password" class="form-control"
                                                                                name="password"
                                                                                placeholder="Enter A Password"
                                                                                value="123456"></div>
                        <input name="submit" type="submit" class="color btn btn-default" value="Log in"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "../includes/footer.php"; ?>

