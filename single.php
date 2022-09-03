<?php
include "header.php";
?>
<html>

<head>
    <title>IT Information</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/96c97d736b.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width">
</head>

<body>
    <div class="main index">
        <div class="main-content">
            <?php
            $conn = mysqli_connect("localhost:3307", "root", "", "news") or die("Query failed");
            $pid = $_GET['id'];
            $sql = "SELECT post.postId,post.postTitle,post.postDescription,post.postDate,post.postImage,post.postAuthor,category.categoryName,category.categoryId,user.userName,user.name FROM post LEFT JOIN category ON post.postCategory = category.categoryId LEFT JOIN user ON post.postAuthor = user.userId WHERE postId = {$pid}";
            $result = mysqli_query($conn, $sql) or die("query failed");
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="single-container">
                        <div class="header1"><?php echo $row['postTitle']; ?></div>
                        <div class="single-post-information">
                            <div class="group">
                                <i class="fas fa-tags"></i>
                                <a href="category.php?catid=<?php echo $row['categoryId']; ?>"><?php echo $row['categoryName']; ?></a>
                            </div>
                            <div class="group">
                                <i class="fas fa-user"></i>
                                <a href="auther.php?aid=<?php echo $row['postAuthor']; ?>"><?php echo $row['name']; ?></a>
                            </div>
                            <div class="group">
                                <i class="fas fa-calendar-alt"></i>
                                <?php echo $row['postDate']; ?>
                            </div>
                        </div>
                        <div class="single-image">
                            <img src="upload/<?php echo $row['postImage'] ?>"; alt="">
                        </div>
                        <div class="single-discription">
                        <?php echo $row['postDescription']; ?>
                        </div>
                    </div>
            <?php
                }
            }
            ?>


            <div class="container2">
                <?php
                include "slidebar.php";
                ?>
            </div>
        </div>
    </div>
</body>

</html>

<?php
include "footer.php";
?>