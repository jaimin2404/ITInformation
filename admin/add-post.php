<?php
include "header.php";
include "navbar.php";
?>
<html>

<head>
    <title>Add Post</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/96c97d736b.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width">
</head>

<body>
    <div class="add-container">
        <div class="container">
            <h1>Add New Post</h1>
            <div class="add-form">
                <form action="save-post.php" method="POST" autocomplete="off" enctype="multipart/form-data" >
                    <div class="group">
                        <input type="hidden" name="postid" value="<?php echo $row['postId']; ?>">
                    </div>
                    <div class="group">
                        <label for="category">Select Post Category</label>
                        <select name="post-category">
                            <option disabled>Select Category</option>
                            <?php
                            $conn = mysqli_connect("localhost:3307", "root", "", "news") or die("Connection failed");

                            $qry = "SELECT * FROM category";
                            $result = mysqli_query($conn, $qry) or die("Query Failed");

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value={$row['categoryId']}>{$row['categoryName']}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="group">
                        <label for="post-title">Post Title</label>
                        <input type="text" placeholder="Title" name="postTitle">
                    </div>
                    <div class="group">
                        <label for="post-discription">Post Discription</label>
                        <textarea name="post-discription" id="post-discription" cols="10" rows="8" placeholder="Post Discription"></textarea>
                    </div>
                    <div class="group">
                        <label for="post-image">Post Image</label>
                        <input type="file" name="post-image" id="post-image">
                    </div>
                    <input type="submit" value="Save" class="btn">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php
include "../footer.php";
?>