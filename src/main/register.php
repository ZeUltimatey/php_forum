<?php
ob_start();
require "../includes/header.php";
require "../config.php";
if (isset($_POST['submit'])) {
    if (empty($_POST['name']) or empty($_POST['email']) or empty($_POST['username']) or empty($_POST['password']) or empty($_POST['about'])) {
        echo "<script> alert('one or more inputs are empty');</script>";
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $about = $_POST['about'];
        $avatar = $_FILES['avatar']['name'];
        $dir = "img/" . basename($avatar);
        if (isset($conn)) {
            $sql = "INSERT INTO users (name, email, username, password, about, avatar) VALUES (:name, :email, :username, :password, :about, :avatar)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'username' => $username,
                'password' => $password,
                'about' => $about,
                'avatar' => $avatar
            ]);
            header("location: login.php");
        } else {
            echo "Database connection not established.";
            exit;
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
                    <h1 class="pull-left">Register</h1>
                    <div class="clearfix"></div>
                    <form role="form" enctype="multipart/form-data" method="post" action="register.php">
                        <div class="form-group">
                            <label>Name*</label> <input type="text" class="form-control" name="name"
                                                        placeholder="Enter Your Name">
                        </div>
                        <div class="form-group">
                            <label>Email Address*</label> <input type="email" class="form-control" name="email"
                                                                 placeholder="Enter Your Email Address">
                        </div>
                        <div class="form-group">
                            <label>Choose Username*</label> <input type="text" class="form-control" name="username"
                                                                   placeholder="Create A Username">
                        </div>
                        <div class="form-group">
                            <label>Password*</label> <input type="password" class="form-control" name="password"
                                                            placeholder="Enter A Password">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password*</label> <input type="password" class="form-control"
                                                                    name="password2" placeholder="Enter Password Again">
                        </div>
                        <div class="form-group"><label>Upload Avatar</label><input type="file" name="avatar">
                            <p class="help-block"></p>
                        </div>
                        <div class="form-group"><label>About Me</label><textarea id="about" rows="6" cols="80"
                                                                                 class="form-control" name="about"
                                                                                 placeholder="Tell us about yourself (Optional)"></textarea>
                        </div>
                        <input name="submit" type="submit" class="color btn btn-default" value="Register"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>