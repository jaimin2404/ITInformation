<?php
    $conn = mysqli_connect("localhost:3307","root","","news");
    session_start();
    if(!isset($_SESSION["adminUserName"])){
        header("Location: http://localhost/PHP/projects/ITinformation/admin/");
    }   
?>
<html>

<head>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo/logo.png">
    <script src="https://kit.fontawesome.com/96c97d736b.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <a href="../index.php"><img src="../logo/logo.png" alt=""></a>
        </div>
        <div class="admin-logout">
        <p>
            <?php echo $_SESSION['adminUserName'] ?>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </div>
</body>
</html>