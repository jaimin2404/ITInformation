<?php
include "header.php";
include "navbar.php";
if (isset($_POST['save'])) {
    $conn = mysqli_connect("localhost:3307", "root", "", "news");

    $catid = mysqli_real_escape_string($conn, $_POST['categoryid']);
    $catname = mysqli_real_escape_string($conn, $_POST['categoryname']);
    $sql1 = "UPDATE category SET categoryName='{$catname}' WHERE categoryId='{$catid}';";
    if (mysqli_query($conn, $sql1)) {
        header("Location: http://localhost/PHP/projects/ITInformation/admin/category.php");
    } else {
        echo "QUery failed";
    }
}
?>
<html>

<head>
    <title>Update category</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/96c97d736b.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width">
</head>

<body>
    <div class="add-container">
        <div class="container">
            <h1>Update Category</h1>
            <div class="add-form">
                <?php
                $conn = mysqli_connect("localhost:3307", "root", "", "news") or die("Connection Fialed");
                $cat_id = $_GET['id'];
                $sql = "SELECT * FROM category WHERE categoryId={$cat_id}";
                $result = mysqli_query($conn, $sql) or die("Query Failed");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="group">
                                <input type="hidden" name="categoryid" value="<?php echo $row['categoryId']; ?>">
                            </div>
                            <div class="group">
                                <label for="category">Category Name</label>
                                <input type="text" placeholder="Category Name" name="categoryname" value="<?php echo $row['categoryName']; ?>">
                            </div>
                            <input type="submit" value="Save" name="save" class="btn">
                        </form>
                <?php
                    }
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