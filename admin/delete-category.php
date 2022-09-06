<?php
    $conn = mysqli_connect("localhost:3308","root","","news");
    $cat_id = $_GET['id'];
    $sql = "DELETE FROM category where categoryId='{$cat_id}'";
    if(mysqli_query($conn,$sql)){
        header("Location: http://localhost/PHP/projects/ITinformation/admin/category.php");
    }
    else{
        echo "<p style='color:red;'>*Can not delete record</p>";
    }
    mysqli_close($conn);
?>