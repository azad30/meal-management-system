<?php
include('connection.php');
if(isset($_GET['id'])){
    $deleteid=$_GET['id'];
    $sql = "DELETE FROM meal_rate WHERE id=$deleteid ";
    if (mysqli_query($connect, $sql)) {
    echo "<div class='alert alert-success'>
   <strong>Success!</strong>Delete Success.
   </div>";
   echo "<script>setTimeout(\"location.href = 'meal_rate.php';\",1500);</script>";  
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
}
?>