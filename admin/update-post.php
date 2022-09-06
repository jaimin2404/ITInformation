<?php
include "header.php";
include "navbar.php";
?>
<html>

<head>
    <title>Update Post</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/96c97d736b.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width">
</head>

<body>
    <div class="add-container">
        <div class="container">
            <h1>Update Post</h1>
            <div class="add-form">
                <?php
                $conn = mysqli_connect("localhost:3308", "root", "", "news") or die("connection failed");
                $post_id = $_GET['id'];
                $qry = "SELECT * FROM post LEFT JOIN category ON post.postCategory = category.categoryId left join user on post.postAuthor=user.userId where postId = {$post_id}";


                $result = mysqli_query($conn, $qry) or die("Query failed");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <form action="save-update-post.php" method="POST" autocomplete="off">
                            <div class="group">
                                <input type="hidden" name="postid" value="<?php echo $row['postId']; ?>">
                            </div>
                            <div class="group">
                                <label for="category">Select Post Category</label>
                                <select name="post-category">
                                    <option disabled>Select category</option>
                                    <?php
                                        $conn = mysqli_connect("localhost","root","","news") or die("connection failed");
                                        $qry1 = "SELECT * FROM category" or die("Query failed");
                                        $result1 = mysqli_query($conn,$qry1) or die("Query failed");
                                        
                                        if(mysqli_num_rows($result1) > 0){
                                            while($row1 = mysqli_fetch_assoc($result1))
                                            {
                                                if($row['postCategory'] == $row1['categoryId']){
                                                    $selected = "selected";
                                                }
                                                else{
                                                    $selected = "";
                                                }
                                                echo "<option {$selected} value={$row1['categoryId']}>{$row1['categoryName']}</option>";
                                            }
                                        }

                                    ?>
                                </select>
                                <input type="hidden" name="old-category" value="<?php echo $row['postCategory'] ?>">
                            </div>
                            <div class="group">
                                <label for="post-title">Post Title</label>
                                <input type="text" placeholder="Title" value="<?php echo $row['postTitle']; ?>" name="post-title">
                            </div>
                            <div class="group">
                                <label for="post-discription">Post Discription</label>
                                <textarea name="post-discription" id="post-discription" cols="10" rows="8" placeholder="Post Discription"><?php echo $row['postDescription']; ?></textarea>
                            </div>
                            <input type="submit" value="Update" class="btn">
                        </form>
                <?php 
                    }
                }else{
                    echo "result not found";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
<?php
include "../footer.php";
?>