<?php
include "header.php";
include "navbar.php";
?>
<html>

<head>
    <title>Admin | Post</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/96c97d736b.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width">
</head>

<body>
    <div class="user-container">
        <div class="container">
            <div class="header">
                <p>All Post</p>
                <div class="btn">
                    <a href="add-post.php">Add Post</a>
                </div>
            </div>
            <?php
            $conn = mysqli_connect("localhost:3307", "root", "", "news");
            $limit = 10;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $offset = ($page - 1) * $limit;
            $sql = "SELECT * FROM post LEFT JOIN category ON post.postCategory = category.categoryId LEFT JOIN user ON post.postAuthor = userId LIMIT {$offset},{$limit}";
            $result = mysqli_query($conn, $sql) or die("QUery failed");
            if (mysqli_num_rows($result) > 0) {
            ?>
                <table>
                    <thead>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Post Date</th>
                        <th>Author</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row['postTitle']; ?></td>
                                <td><?php echo $row['categoryName']; ?></td>
                                <td><?php echo $row['postDate']; ?></td>
                                <td><?php echo $row['userName']; ?></td>
                                <td><a href="update-post.php?id=<?php echo $row['postId']; ?>&catid=<?php echo $row['postCategory']; ?>"><i class="fas fa-edit"></i></a></td>
                                <td><a href="delete-post.php?id=<?php echo $row['postId']; ?>&catid=<?php echo $row['postCategory']; ?>"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php
            }

            $qrypagination = "SELECT * FROM post";
            $resultpagination = mysqli_query($conn, $qrypagination) or die("QUery failed");

            if (mysqli_num_rows($resultpagination) > 0) {
                $totalRecord = mysqli_num_rows($resultpagination);
                $totalPage = ceil($totalRecord / $limit);
                echo '<div class="pagination">';
                echo '<div class="page">';
                echo '<ul>';
                if ($page > 1) {
                    echo "<li><a href='post.php?page=" . ($page - 1) . "'>Prev</a></li>";
                }
                for ($i = 1; $i <= $totalPage; $i++) {
                    if ($i == $page) {
                        $active = "active";
                    } else {
                        $active = "";
                    }
                    echo '<li class="' . $active . '"><a href="post.php?page=' . $i . '">' . $i . '</a></li>';
                }
                if ($totalPage > $page)
                    echo "<li><a href='post.php?page=" . ($page + 1) . "'>Next</a></li>";
                echo "</ul>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>

</html>
<?php
include "../footer.php";
?>