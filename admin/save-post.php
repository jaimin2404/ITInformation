<?php
$conn = mysqli_connect("localhost:3308","root","","news");

if(isset($_FILES['post-image'])){
    $error = array();

    $fileName = $_FILES['post-image']['name'];
    $fileSize = $_FILES['post-image']['size'];
    $fileTmp = $_FILES['post-image']['tmp_name'];
    $fileType = $_FILES['post-image']['type'];
    $fileExt = strtolower(end(explode('.',$fileName)));
    $extension = array("jpeg","jpg","png");

    if(in_array($fileExt,$extension) === false){
        $error[] = "extension of file does not allowed, please select jpeg, jpg or png file";
    }

    if(empty($error) == true){
        move_uploaded_file($fileTmp,"../upload/".$fileName);
    }
    else{
        print_r($error);
        die();
    }
}

session_start();
$postCategory = mysqli_real_escape_string($conn,$_POST['post-category']);
$postTitle = mysqli_real_escape_string($conn,$_POST['postTitle']);
$postDescription = mysqli_real_escape_string($conn,$_POST['post-discription']);
$postDate = date("d M,Y");
$postAuthor = $_SESSION['adminUserId'];

$sql = "INSERT INTO post(postTitle,postDescription,postDate,postImage,postCategory,postAuthor) 
        VALUES('{$postTitle}','{$postDescription}','{$postDate}','{$fileName}','{$postCategory}','{$postAuthor}');";
$sql .= "UPDATE category SET post = post + 1 WHERE categoryId = {$postCategory}";

if(mysqli_multi_query($conn,$sql)){
    header("location: http://localhost/PHP/projects/ITInformation/admin/Post.php");
}
else{
    "<p>Query failed</p>";
}
?>