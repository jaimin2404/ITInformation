<?php
    $conn = mysqli_connect("localhost:3307","root","","news");
    $catId = $_GET['catid'];

    $sql1 = "SELECT *  FROM category WHERE categoryId = '{$catId}';";
    $result = mysqli_query($conn,$sql1) or die("Query Failed");
    $row = mysqli_fetch_assoc($result);

    unlink('../upload/'.$row['postImage']);
    $sql = "DELETE FROM post WHERE postId = '{$postId}';";
    $sql .= "UPDATE category set post = post - 1 WHERE categoryId = '{$catId}';"; 
    if(mysqli_multi_query($conn,$sql)){
        header("location: http://localhost/PHP/projects/ITInformation/admin/post.php");
    }
    else{
        echo "<p style='color:red;'>*Can not delete record</p>";
    }
    mysqli_close($conn);
?>