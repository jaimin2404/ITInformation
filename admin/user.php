<?php
include "header.php";
include "navbar.php";
?>
<html>

<head>
    <title>Admin | User</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo/logo.png">
    <script src="https://kit.fontawesome.com/96c97d736b.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width">
</head>

<body>
    <div class="user-container">
        <div class="container">
            <div class="header">
                <p>All Users</p>
                <div class="btn">
                    <a href="add-user.php">Add User</a>
                </div>
            </div>
            <?php
                $conn = mysqli_connect("localhost:3308","root","","news") or die("Connection Failed");
                $limit = 3;
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }   
                else{
                    $page = 1;
                }
                $offset = ($page - 1)  * $limit; 
                $sql = "SELECT * FROM user LIMIT {$offset},{$limit};";
                $result = mysqli_query($conn,$sql) or die("Query Failed");
                if(mysqli_num_rows($result) > 0){
            ?>
            <table>
                <thead>
                    <th>User Id</th>
                    <th>Name</th>
                    <th>Birth Date</th>
                    <th>Email</th>
                    <th>User Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <tr>
                        <td><?php echo $row['userId']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['birthdate']; ?></td>
                        <td><?php echo $row['emailid']; ?></td>
                        <td><?php echo $row['userName']; ?></td>
                        <td><a href="update-user.php?id=<?php echo $row['userId']; ?>"><i class="fas fa-edit"></i></a></td>
                        <td><a href="delete-user.php?id=<?php echo $row['userId']; ?>"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php
            } 

            $qrypagination = "SELECT * FROM user";
            $resultpagination = mysqli_query($conn,$qrypagination) or die("Query failed"); 

            if(mysqli_num_rows($resultpagination) > 0){
                $total_record = mysqli_num_rows($resultpagination);
               
                $total_page = ceil($total_record/$limit);
                echo '<div class="pagination">';
                echo '<div class="page">';
                echo "<ul>";
                if($page > 1){
                    echo "<li><a href='user.php?page=".($page - 1)."'>Prev</a></li>";
                }
                for($i=1;$i<=$total_page;$i++){
                    if($i == $page){
                        $active = "active";
                    }
                    else{
                        $active = "";
                    }
                    echo '<li class="'.$active.'"><a href="user.php?page='.$i.'">'.$i.'</a></li>';
                }
                if($total_page > $page)
                echo "<li><a href='user.php?page=".($page + 1)."'>Next</a></li>";
                echo "</ul>";
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
            
    </div>
</body>

</html>
<?php
    include "../footer.php";
?>