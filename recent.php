<html>

<body>
    <div class="recent-container">
        <div class="head">
            Search
        </div>
        <div class="search">
            <form action="search.php" method="GET">
                <input type="text" name="search" placeholder="search here...">
                <button type="submit">Search</button>
            </form>
        </div>
        <br>
        <hr>
        <br>
        <div class="head">
            Recent Post
        </div>
        <?php
        $conn = mysqli_connect("localhost:3307", "root", "", "news");
        $limit = 5;
        $sql = "SELECT post.postId,post.postTitle,post.postDescription,post.postDate,post.postImage,post.postAuthor,user.userId,category.categoryId,category.categoryName,user.userName,user.name FROM post LEFT JOIN category ON post.postCategory = category.categoryId LEFT JOIN user ON post.postAuthor = user.userId ORDER BY post.postId DESC LIMIT {$limit}";

        $result = mysqli_query($conn, $sql) or die("QUery failed");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="content">
                    <div class="news-image">
                        <a href="single.php?id=<?php echo $row['postId']; ?>"><img src="upload/<?php echo $row['postImage']; ?>" alt=""></a>
                    </div>
                    <div class="news-container">
                        <div class="header2"><a href="single.php?id=<?php echo $row['postId']; ?>"><?php echo $row['postTitle']; ?></a></div>
                        <div class="news-detail">
                            <div class="group">
                                <i class="fas fa-tags"></i>
                                <a href="category.php?catid=<?php echo $row['categoryId']; ?>"><?php echo $row['categoryName']; ?></a>
                            </div>
                            <div class="group">
                                <i class="fas fa-calendar-alt"></i>
                                <?php echo $row['postDate']; ?>
                            </div>
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
        ?>
    </div>
</body>

</html>