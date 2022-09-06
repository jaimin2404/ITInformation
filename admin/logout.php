<?php
    $conn = mysqli_connect("localhost:3308","root","","news") or die("Connection Failed");

    session_start();
    session_unset();
    session_destroy();
    header("Location: http://localhost/PHP/projects/ITInformation/admin/");
?>