<?php
include "header.php";
?>
<html>

<head>
    <title>IT Information</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="logo/logo.png">
    <script src="https://kit.fontawesome.com/96c97d736b.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width">
</head>

<body>
    <div class="main index">
        <div class="main-content">
            <div class="container">
                <?php
                $conn = mysqli_connect("localhost:3307", "root", "", "news");
                $limit = 10;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $offset = ($page - 1) * $limit;
                $sql = "SELECT post.postId,post.postTitle,post.postDescription,post.postDate,post.postImage,post.postAuthor,user.userId,category.categoryId,category.categoryName,user.userName,user.name FROM post LEFT JOIN category ON post.postCategory = category.categoryId LEFT JOIN user ON post.postAuthor = user.userId ORDER BY post.postId DESC LIMIT {$offset},{$limit}";

                $result = mysqli_query($conn, $sql) or die("QUery failed");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>

                        <div class="content">
                            <div class="news-image">
                                <a href="single.php?id=<?php echo $row['postId'] ?>"><img src="upload/<?php echo $row['postImage']; ?>"></a>
                            </div>
                            <div class="news-container">
                                <div class="header2"><a href="single.php?id=<?php echo $row['postId']; ?>"><?php echo $row['postTitle']; ?></a></div>
                                <div class="news-detail">
                                    <div class="group">
                                        <i class="fas fa-tags"></i>
                                        <a href="category.php?catid=<?php echo $row['categoryId']; ?>"><?php echo $row['categoryName']; ?></a>
                                    </div>
                                    <div class="group">
                                        <i class="fas fa-user"></i>
                                        <a href="auther.php?aid=<?php echo $row['postAuthor']; ?>"><?php echo $row['name']; ?></a>
                                    </div>
                                    <div class="group"><i class="fas fa-calendar-alt"></i><?php echo $row['postDate']; ?></div>
                                </div>
                                <div class="news-data">
                                    <a href="single.php?id=<?php echo $row['postId']; ?>"><?php echo substr($row['postDescription'],0,130)."..." ; ?></a>
                                </div>
                                <div class="btn-news">
                                    <a href="single.php?id=<?php echo $row['postId']; ?>" class="btnread-more">Read More</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                <?php
                    }
                }
                else{
                    echo "<h1>No record Found</h1>";
                }
                $qryPagination = "SELECT * FROM post";
                $resultPagination = mysqli_query($conn, $qryPagination) or die("QUery failed");

                if (mysqli_num_rows($result) > 0) {
                    $totalRecord = mysqli_num_rows($resultPagination);
                    $totalPage = ceil($totalRecord / $limit);
                    echo "<div class='pagination'>";
                    echo "<div class='page'>";
                    echo "<ul>";
                    if ($page > 1) {
                        echo "<li><a href='index.php?page=" . ($page - 1) . "'>Prev</li>";
                    }
                    for ($i = 1; $i <= $totalPage; $i++) {
                        if ($i == $page) {
                            $active  = "active";
                        } 
                        else {
                            $active = "";
                        }
                        echo '<li class="'.$active.'"><a href="index.php?page='.$i.'">'.$i.'</a></li>';
                    }
                    if ($totalPage > $page) {
                        echo "<li><a href='index.php?page=" . ($page + 1) . "'>Next</a></li>";
                    }
                    echo "</ul>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>

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