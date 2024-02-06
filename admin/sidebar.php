<?php
    require("db-connect.php");
    session_start();
    $sql = "SELECT * FROM tbl_users WHERE id= '{$_SESSION["id"]}'";
    $query = mysqli_query($db, $sql);

    $row = mysqli_fetch_assoc($query)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>

    <!-- @theme style -->
    <link rel="stylesheet" href="assets/style/theme.css">

    <!-- @Bootstrap -->
    <link rel="stylesheet" href="assets/style/bootstrap.css">

    <!-- @script -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</head>
<style>
    .child > li {
        text-align:center;
    }
    .child li a { margin-bottom: 3px; }
    .child > li > form > .a {
        padding: 10px;
        width: 100%;
        display: block;
        color: white;
        background: #064489;
        border: none;
        margin-bottom: 3px;
    }
</style>
<body>
    <main class="admin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2">
                    <div class="content-left">
                        <div class="wrap-top">
                            <img src="assets/icon/admin-logo.png" alt="">
                            <h5>Jong Deng News</h5>
                        </div>
                        <div class="wrap-center">
                            <img style="width: 49px; height: 49px; object-fit: cover;" src="https://res.cloudinary.com/dvsqwcz7u/image/upload/<?php echo $row["profile"] ?>.jpg" alt="IMG">
                            <h6>Welcome Admin <?php echo $row["firstName"]?></h6>
                        </div>
                        <div class="wrap-bottom">
                            <ul>
                                <!-- news -->
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>News</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <form action="" method="post">
                                                <a class="a" href="view-post.php" name="">View Post</a>
                                                <a class="a" href="add-post.php" name="">Add News</a>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                <!-- logo -->
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>Logo</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <form action="" method="post">
                                                <a class="a" href="view-logo.php" name="view-logo">View Logo</a>
                                                <a class="a" href="add-logo.php" name="add-logo">Add New</a>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                <!-- about us -->
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>About US Info</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <form action="" method="post">
                                                <a class="a" href="view-info.php" name="view-info">View Info</a>
                                                <a class="a" href="add-info.php" name="add-info">Add New</a>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                <!--social -->
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>Social Media</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <form action="" method="post">
                                                <a class="a" href="view-social.php" name="view-info">View All Social</a>
                                                <a class="a" href="add-social.php" name="add-info">Add New</a>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                <!-- feedback -->
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>Users feedback</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <form action="" method="post">
                                                <a class="a" href="view-user-feedback.php" name="view-logo">View Feedback</a>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                <!-- other -->
                                <li class="parent">
                                    <a class="parent" href="javascript:void(0)">
                                        <span>Other</span>
                                        <img src="assets/icon/arrow.png" alt="">
                                    </a>
                                    <ul class="child">
                                        <li>
                                            <a href="https://t.me/Rxakk_Dev" target="_blank">Contect Developer</a>
                                            <a style="color: red; " href="logout.php">Log out</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>