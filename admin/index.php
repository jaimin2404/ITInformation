<?php
$conn = mysqli_connect("localhost:3307", "root", "", "news");
session_start();
if (isset($_SESSION['adminUserName'])) {
    header("Location: http://localhost/PHP/projects/ITInformation/admin/user.php");
}
?>
<html>

<head>
    <title>Admin | Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo/logo.png">
    <script src="https://kit.fontawesome.com/96c97d736b.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width">
</head>

<body>
    <div class="admin-container">
        <div class="login-form">
            <h1>Admin Login</h1>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                <div class="username">
                    <label for="admin-username">Username</label>
                    <input type="text" placeholder="Username" name="username">
                </div>
                <div class="password">
                    <label for="admin-password">Password</label>
                    <input type="password" name="password" placeholder="password">
                </div>
                <div class="btn">
                    <input type="submit" value="Login" name="login">
                </div>
            </form>
            <?php
            if (isset($_POST['login'])) {
                $conn = mysqli_connect("localhost:3307", "root", "", "news");
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $pass = md5($_POST['password']);

                $sql = "SELECT * from user WHERE userName='{$username}' AND password='{$pass}'";
                $result = mysqli_query($conn, $sql) or die("Query Failed");

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        session_start();
                        $_SESSION["adminUserId"] = $row['userId'];
                        $_SESSION["adminUserName"] = $row['userName'];
                        $_SESSION["adminPassword"] = $row['password'];
                        header("Location: http://localhost/PHP/projects/ITinformation/admin/user.php");
                    }
                } else {
                    echo "<div style='color:red;'>*UserName or password not matched</div>";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>

<?php
include "../footer.php";
?>