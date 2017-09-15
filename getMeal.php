<?php
session_start();
if (!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
    header("location: login.php");
    exit();
}
$session_id=$_SESSION['username'];
?>
<?php include('connection.php'); ?>

<?php 


		
		$selectMeal = "select mealinput from meal where member_id = '".$_POST['id']."' ";
		$member_total_meal = mysqli_query($connect,$selectMeal);

		$row = mysqli_fetch_array($member_total_meal);
		echo $row['mealinput'];

        // while ($row = mysqli_fetch_array($member_total_meal)) {
        // 	echo  $row['mealinput'];
        	
        // }
 ?>