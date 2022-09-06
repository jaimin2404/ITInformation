<?php
    $conn = mysqli_connect("localhost:3308","root","","news");
    $user_id = $_GET['id'];
    $sql = "DELETE FROM user where userId='{$user_id}'";
    if(mysqli_query($conn,$sql)){
        header("Location: http://localhost/PHP/projects/ITInformation/admin/user.php");
    }
    else{
        echo "<p style='color:red;'>*Can not delete record</p>";
    }
    mysqli_close($conn);
?>