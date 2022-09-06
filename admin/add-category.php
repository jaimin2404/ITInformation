<?php
include "header.php";
include "navbar.php";
if (isset($_POST['save'])) {
    $conn = mysqli_connect("localhost:3308", "root", "", "news");
    $categoryname = mysqli_real_escape_string($conn, $_POST['catname']);
    $sql1 = "INSERT INTO category (categoryName) VALUES ('{$categoryname}');";
    if (mysqli_query($conn, $sql1)) {
        header("Location: http://localhost/PHP/projects/ITinformation/admin/category.php");
    } else {
        echo "QUery failed";
    }
}
?>
<html>

<head>
    <title>Add category</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/96c97d736b.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width">
</head>

<body>
    <div class="add-container">
        <div class="container">
            <h1>Add New Category</h1>
            <div class="add-form">
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                    <div class="group">
                        <label for="category">Category Name</label>
                        <input type="text" name="catname" placeholder="Category Name">
                    </div>
                    <input type="submit" value="Save" name="save" class="btn">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php
    include "../footer.php";
?>