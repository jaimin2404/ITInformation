<?php
include "header.php";
include "navbar.php";
?>
<html>

<head>
    <title>Admin | Category</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo/logo.png">
    <script src="https://kit.fontawesome.com/96c97d736b.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width">
</head>

<body>
    <div class="user-container">
        <div class="container">
            <div class="header">
            <p>All Category</p>
                <div class="btn">
                    <a href="add-category.php">Add Category</a>
                </div>
            </div>
            <?php
                $conn = mysqli_connect("localhost:3307","root","","news") or die("Connection Failed");
                $limit = 10;
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }   
                else{
                    $page = 1;
                }
                $offset = ($page - 1)  * $limit; 
                $sql = "SELECT * FROM category LIMIT {$offset},{$limit};";
                $result = mysqli_query($conn,$sql) or die("Query Failed");
                if(mysqli_num_rows($result) > 0){
            ?>
            <table>
                <thead>
                    <th>Category Id</th>
                    <th>Category Name</th>
                    <th>No. of Post</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?php echo $row['categoryId'] ?></td>
                        <td><?php echo $row['categoryName'] ?></td>
                        <td><?php echo $row['post'] ?></td>
                        <td><a href="update-category.php?id=<?php echo $row['categoryId']; ?>"><i class="fas fa-edit"></i></a></td>
                        <td><a href="delete-category.php?id=<?php echo $row['categoryId']; ?>"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php 
            }
            $qrypagination = "SELECT * FROM category";
            $resultpagination = mysqli_query($conn,$qrypagination) or die("Query failed"); 

            if(mysqli_num_rows($resultpagination) > 0){
                $total_record = mysqli_num_rows($resultpagination);
               
                $total_page = ceil($total_record/$limit);
                echo '<div class="pagination">';
                echo '<div class="page">';
                echo "<ul>";
                if($page > 1){
                    echo "<li><a href='category.php?page=".($page - 1)."'>Prev</a></li>";
                }
                for($i=1;$i<=$total_page;$i++){
                    if($i == $page){
                        $active = "active";
                    }
                    else{
                        $active = "";
                    }
                    echo '<li class="'.$active.'"><a href="category.php?page='.$i.'">'.$i.'</a></li>';
                }
                if($total_page > $page)
                echo "<li><a href='category.php?page=".($page + 1)."'>Next</a></li>";
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