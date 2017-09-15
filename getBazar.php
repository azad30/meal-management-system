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


		$selectBazar = "select sum(amount) from bazar_money where member_id = '".$_POST['id']."' group by member_id";
		$member_total_bazar = mysqli_query($connect,$selectBazar);
        
		$row = mysqli_fetch_array($member_total_bazar);
		echo $row['sum(amount)'];
 ?>