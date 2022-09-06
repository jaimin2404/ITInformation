<?php
$conn = mysqli_connect("localhost:3308", "root", "", "news") or die("COnnection failed");
$page = basename($_SERVER['PHP_SELF']);
switch ($page) {
    case "single.php":
        if (isset($_GET['id'])) {
            $title = "SELECT * FROM post WHERE postId={$_GET['id']}";
            $result = mysqli_query($conn, $title) or die("QUery Failed");
            $row = mysqli_fetch_assoc($result);
            $pageTitle = $row['postTitle'];
        } else {
            $pageTitle = "No post";
        }
        break;
    case "category.php":
        if (isset($_GET['catid'])) {
            $title = "SELECT * FROM category WHERE categoryId={$_GET['catid']}";
            $result = mysqli_query($conn, $title) or die("QUery Failed");
            $row = mysqli_fetch_assoc($result);
            $pageTitle = $row['categoryName'];
        } else {
            $pageTitle = "No post";
        }
        break;
    case "auther.php":
        if (isset($_GET['aid'])) {
            $title = "SELECT * FROM user WHERE userId={$_GET['aid']}";
            $result = mysqli_query($conn, $title) or die("QUery Failed");
            $row = mysqli_fetch_assoc($result);
            $pageTitle = $row['name'];
        } else {
            $pageTitle = "No post";
        }
        break;
    case "search.php":
        if (isset($_GET['search'])) {
            $pageTitle = $_GET['search'];
        } else {
            $pageTitle = "No post";
        }
        break;
    default:
        $pageTitle = "IT Information";
        break;
}
?>
<html>

<head>
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="logo/logo.png">
    <script src="https://kit.fontawesome.com/96c97d736b.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav>
        <div class="navbar">
            <div class="logo">
                <a href="main.php"><img src="logo/logo.png" alt=""></a>
            </div>
            <div class="contact-us">
                <div class="contact"><i class="far fa-id-card"></i>Contact For Making Website</div>
                <div class="contact"><i class="far fa-envelope"></i>prajapatijaimin2404@gmail.com</div>
                <div class="contact"><i class="fas fa-phone"></i>+91 8849659074</div>
            </div>
        </div>
        <?php
        $conn = mysqli_connect("localhost:3307", "root", "", "news") or die("Connection failed");
        if (isset($_GET['catid'])) {
            $catId = $_GET['catid'];
        }

        $sql = "SELECT * FROM category where post > 0";
        $result = mysqli_query($conn, $sql) or die("Query failed");
        if (mysqli_num_rows($result) > 0) {
            $active = "";
        ?>
            <ul>
                <li><a href="main.php">Home</a></li>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    if (isset($_GET['catid'])) {
                        if ($row['categoryId'] == $catId) {
                            $active = "active";
                        } else {
                            $active = "";
                        }
                    }
                    echo "<li><a class='{$active}' href='category.php?catid={$row['categoryId']}'>{$row['categoryName']}</a></li>";
                }
                ?>
            </ul>
        <?php } ?>
    </nav>
</body>

</html>