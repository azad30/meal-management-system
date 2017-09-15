<?php
include('connection.php');
if(isset($_GET['id'])){
    $deleteid=$_GET['id'];
    $sql = "DELETE FROM category WHERE id=$deleteid ";
    if (mysqli_query($connect, $sql)) {
        echo "category deleted successfully";
        header('Location: category.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
}
?>