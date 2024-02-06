<?php
$db = mysqli_connect('localhost', 'root', '', 'db_cms_news');
if (!$db)
    die("Could not connect to database". mysqli_error());