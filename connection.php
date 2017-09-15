<?php
$connect = mysqli_connect("localhost","root","","meal");
if(!$connect){
	echo "Error".mysqli_error();
}
?>