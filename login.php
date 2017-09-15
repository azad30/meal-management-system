<?php session_start(); ?>
<html>
<head>
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="login-page">
  <div class="form">
    <?php
include("connection.php");
  if (isset($_POST['login'])){
      $username = mysqli_real_escape_string($connect, $_POST['username']);
      $password = mysqli_real_escape_string($connect, $_POST['password']);
      $query    = mysqli_query($connect,"SELECT * 
        FROM member WHERE name='$username' and password=md5('$password')");
      $row    = mysqli_fetch_array($query);
      $num_row  = mysqli_num_rows($query);
      if ($num_row > 0) 
        {     
          $_SESSION['username']=$row['name'];
		  $_SESSION['id']=$row['id'];
           header('location:user.php');
        }
        if($username=='Admin' && $password =='123'){
            header('location:admin.php');
        }
      else
        {
           echo "<div class='alert alert-danger'>
            Wrong Username and Password
      </div>"; 
        }
    }
  ?>
    <form class="login-form" method="POST" action="">
	   <h4 class="text-center">Welcome to meal system</h4>
      <input type="text" name="username" placeholder="username"/>
      <input type="password" name="password" placeholder="password"/>
      <button type="submit" name="login">login</button>
      <p class="message">Not registered? <a href="register.php">Create an account</a></p>
    </form>
  </div>
</div>
</body>
</html>
