<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!defined('APPURL')) {
    define("APPURL", "http://localhost:8080");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forum</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
</head>
<body>
<div class="header" role="navigation">
    <nav>
        <ul class="nav-links">
            <li class="logo"><a href="<?php echo APPURL; ?>/index-user.php">Forum</a></li>
            <?php if (isset($_SESSION['username'])) : ?>
                <li><a href="<?php echo APPURL; ?>/topics/create-topic-user.php">Create Topic</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><?php echo $_SESSION['username']; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo APPURL; ?>/main/user.php?name=<?php echo $_SESSION['username']; ?>">Public
                                Profile</a></li>
                        <li>
                            <a href="<?php echo APPURL; ?>/main/user-edit.php?id=<?php echo $_SESSION['user_id']; ?>">Edit
                                Profile</a></li>
                        <li><a href="<?php echo APPURL; ?>/main/logout.php">Logout</a></li>
                    </ul>
                </li>
            <?php else : ?>
                <li><a href="<?php echo APPURL; ?>/main/register.php">Register</a></li>
                <li><a href="<?php echo APPURL; ?>/main/login.php">Login</a></li>
            <?php endif; ?>
            <div class="header-container">
                <button id="toggle-theme-button">Theme</button>
            </div>
        </ul>
    </nav>
</div>
<script src="/js/theme.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>