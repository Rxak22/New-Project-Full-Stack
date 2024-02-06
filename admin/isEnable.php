<?php
    require('db-connect.php');

    $sql0 = "UPDATE tbl_about_us SET status= 0 WHERE id= '{$_GET['id']}'"; 
    $sql1 = "UPDATE tbl_about_us SET status= 1 WHERE id NOT IN ('{$_GET['id']}')"; 

    $query0 = mysqli_query($db, $sql0);
    $query1 = mysqli_query($db, $sql1);

    header('location: view-info.php');
    exit();