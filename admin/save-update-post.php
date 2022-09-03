<?php
$conn = mysqli_connect("localhost:3307","root","","news");

$sql = "UPDATE post SET postCategory={$_POST['post-category']},postTitle='{$_POST['post-title']}',postDescription='{$_POST['post-discription']}' WHERE postId={$_POST['postid']};";
if($_POST['old-category'] != $_POST['post-category']){
    $sql .= "UPDATE category SET post = post - 1 WHERE categoryId = {$_POST['old-category']};";
    $sql .= "UPDATE category SET post = post + 1 WHERE categoryId = {$_POST['post-category']};";
}
if (mysqli_multi_query($conn,$sql)){
    header("location: http://localhost/PHP/projects/ITInformation/admin/Post.php");
} 
else {
    echo "query failed";
}
?>