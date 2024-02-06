<?php
    // remove session cookie
    session_start();
    unset($_SESSION['id']);
    header("location: login.php");
    exit();