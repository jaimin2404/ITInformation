<?php
include "header.php";
include "navbar.php";

if (isset($_POST['save'])) {
    $conn = mysqli_connect("localhost:3308", "root", "", "news") or die("connection Failed...");
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    $sql = "SELECT userName FROM user WHERE username='{$username}'";
    $result = mysqli_query($conn, $sql)  or die("Query failes");

    if (mysqli_num_rows($result) > 0) {
        echo "<p style='color:red;'>*Username already in use</p>";
    } else {
        $sql1 = "INSERT INTO user(name,birthdate,emailid,userName,password) values ('{$name}','{$birthdate}','{$email}','{$username}','{$password}')";
        if (mysqli_query($conn, $sql1)) {
            header("Location: http://localhost/PHP/projects/ITinformation/admin/user.php");
        }
    }
}
?>
<html>

<head>
    <title>Add User</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/96c97d736b.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width">
</head>

<body>
    <div class="add-container">
        <div class="container">
            <h1>Add New User</h1>
            <div class="add-form">
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                    <div class="group">
                        <input type="hidden" name="userid" value="<?php echo $row['userId']; ?>">
                    </div>
                    <div class="group">
                        <label for="name">Name</label>
                        <input type="text" placeholder="Name" name="name" required>
                    </div>
                    <div class="group">
                        <label for="birthdate">Birth Date</label>
                        <input type="date" name="birthdate" id="birthdate" required>
                    </div>
                    <div class="group">
                        <label for="email">Email Id</label>
                        <input type="email" name="email" id="email" placeholder="Email id" required>
                    </div>
                    <div class="group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="username" required>
                    </div>
                    <div class="group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="6-character(0-9,a-z,A-Z,special-character)" required>
                    </div>
                    <input type="submit" value="Save" class="btn" name="save">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php
include "../footer.php";
?>