<?php
include('connection.php');
if(isset($_POST['user_update'])){
    $name      = $_POST['member_name'];
    $pass      = $_POST['member_pass'];
    $mobile    = $_POST['mobile_no'];
    $updateid  = $_POST['hiddenid'];
    $sql = "UPDATE member SET name='$name',password=md5($pass),mobile='$mobile' WHERE id=$updateid";
    if (mysqli_query($connect,$sql)) {
       echo "<div class='alert alert-success'>
						  <strong>Success!</strong>Information Update.
						</div>";
            echo "<script>setTimeout(\"location.href = 'member.php';\",1500);</script>";
    } else {
        echo "Error:".$sql."<br>".mysqli_error($connect);
    }
}
?>