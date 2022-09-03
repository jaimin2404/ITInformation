<?php
include "header.php";
include "navbar.php";

if(isset($_POST['save'])){
    $conn = mysqli_connect("localhost","root","","news");
    
    $userid = mysqli_real_escape_string($conn,$_POST['userid']);
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $birthdate = mysqli_real_escape_string($conn,$_POST['birthdate']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);

    $sql = "SELECT userName from user where userName='{$username}'";
    $result = mysqli_query($conn,$sql) or die("query failed");
    if(mysqli_num_rows($result) > 0){
        echo '<p style="color:red">*username already exist</p>';
    }
    else{
        $sql1 = "UPDATE user SET name='{$name}',birthdate='{$birthdate}',emailid='{$email}',userName='{$username}' WHERE userId='{$userid}'";
        if(mysqli_query($conn,$sql1)){
            header("Location: http://localhost/PHP/projects/ITinformation/admin/user.php");
        }
    }

}
?>
<html>

<head>
    <title>Update User</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/96c97d736b.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width">
</head>

<body>
    <div class="add-container">
        <div class="container">
            <h1>Update User</h1>
            <div class="add-form">
                <?php
                    $conn = mysqli_connect("localhost:3307","root","","news") or die("Connection Fialed");
                    $user_id = $_GET['id'];
                    $sql = "SELECT * FROM user WHERE userId={$user_id}";
                    $result = mysqli_query($conn,$sql) or die("Query Failed");
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                ?>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="group">
                        <input type="hidden" name="userid" value="<?php echo $row['userId']; ?>">
                    </div>
                    <div class="group">
                        <label for="name">Name</label>
                        <input type="text" name="name" placeholder="Name" value="<?php echo $row['name']; ?>" required>
                    </div>
                    <div class="group">
                        <label for="birthdate">Birth Date</label>
                        <input type="date" name="birthdate" id="birthdate" value="<?php echo $row['birthdate']; ?>" required>
                    </div>
                    <div class="group">
                        <label for="email">Email Id</label>
                        <input type="email" name="email" id="email" placeholder="Email id" value="<?php echo $row['emailid']; ?>" required>
                    </div>
                    <div class="group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="username" value="<?php echo $row['userName']; ?>" required>
                    </div>
                    <input type="submit" value="Save" class="btn" name="save">
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