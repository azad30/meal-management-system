<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 
crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="login-page">
 <div class="form">
 <?php
include('connection.php');
if(isset($_POST['register'])){
   $name         = $_POST['username'];
    $pass         = $_POST['password'];
    $mobile       = $_POST['mobile']; 
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
//      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      $file_ext = pathinfo($_FILES["image"]["name"]);
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/".$file_name);
      }
   
  if(empty($name)){
	 echo "<div class='alert alert-danger'>
            Please Fillup the name.
      </div>"; 
  }
   if(empty($pass)){
	 echo "<div class='alert alert-danger'>
           Enter Password.
      </div>"; 
  }
   if(empty($mobile)){
	 echo "<div class='alert alert-danger'>
           Enter Mobile No.
      </div>"; 
  }
  else{

	  $register = "INSERT INTO member (name,password,mobile,image) VALUES ('$name',md5('$pass'),'$mobile','$file_name')";
	  $result   = mysqli_query($connect,$register);
	  echo "<div class='alert alert-success'>
  <strong>Success!</strong> Registration Success.
</div>";
 echo "<script>setTimeout(\"location.href = 'login.php';\",1500);</script>";
  }
}
?>
    <form class="login-form" method="POST" action="register.php" enctype="multipart/form-data">
      <input type="text" name="username" placeholder="username"/>
      <input type="password" name="password" placeholder="password"/>
      <input type="text" name="mobile" placeholder="Mobile No"/>
	  <input type="file" name="image" placeholder="upload image"/>
      <button type="submit" name="register">Register</button>
           <p class="message">Already registered? <a href="login.php">Login</a></p>
    </form>
  </div>
</div>
</body>
</html>