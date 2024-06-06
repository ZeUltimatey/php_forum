<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!defined('ADMINURL')) {
    define("ADMINURL", "http://localhost:8080");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
</head>
<body>
<div class="header" role="navigation">
    <nav>
        <ul class="nav-links">
            <li class="logo"><a href="<?php echo ADMINURL; ?>/index-admin.php">Logo
                    <!-- <img src="/img/logo.png" alt="Logo" /> --></a></li>
            <?php $str = 'adminname';
            if (isset($_SESSION[$str])) : ?>
                <li><a href="<?php echo ADMINURL; ?>/main/admins.php">Admins</a></li>
                <li><a href="<?php echo ADMINURL; ?>/categories/show-category-admin.php">Categories</a></li>
                <li><a href="<?php echo ADMINURL; ?>/topics/show-topic-admin.php">Topics</a></li>
                <li><a href="<?php echo ADMINURL; ?>/replies/show-replies-admin.php">Replies</a></li>
                <div class="dropdown">
                    <li><a href="<?php echo ADMINURL; ?>/main/logout-admin.php">Logout</a></li>
                </div>
            <?php else : ?>
                <li><a href="<?php echo ADMINURL; ?>/main/login-admins.php">Login</a></li>
            <?php endif; ?>
            <div class="header-container">
                <button id="toggle-theme-button">Theme</button>
            </div>
        </ul>
    </nav>
</div>
<script src="../js/theme.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>