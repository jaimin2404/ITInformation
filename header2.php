<?php
    $conn = mysqli_connect("localhost:3308","root","","news");
    session_start();
    if(!isset($_SESSION["userName"])){
        header("Location: http://localhost/PHP/projects/latestNews/");
    }   
?>
<html>

<head>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="logo/logo.png">
    <script src="https://kit.fontawesome.com/96c97d736b.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <a href="../main.php"><img src="logo/logo.png" alt=""></a>
        </div>
        <div class="admin-logout">
        <p><?php echo $_SESSION['userName']; ?>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </div>
</body>
</html>