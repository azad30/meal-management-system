<?php
session_start();
if (!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
    header("location: login.php");
    exit();
}
$session_id=$_SESSION['username'];
?>
<?php include('header.php'); ?>
<body>
<div id="wrapper col-md-12">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html"></a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo $_SESSION['username'];?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="divider"></li>
                    <li>
                        <a href="logout.php"><i class="fa fa-fw fa-power-off"></i>Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    </nav>
    <div id="page-wrapper">
        <div class="container">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                </div>
            </div>
            <!-- /.row -->
            <div class="row">

                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Create Meal
                        </div>
						<br>
                        <form method="POST" action="">
						<?php
							include('connection.php');
							if(isset($_POST['meal_create'])){
								$meal =$_POST['mealinput'];
								$time = $_POST['option'];
								$date=date("l jS \ F Y ");
								$userid= $_SESSION['id'];
								
								if(empty($meal)){
								echo "<div class='alert alert-danger'>
								   Please fillup.
							  </div>";		   
								}
								if(empty($time)){
								echo "<div class='alert alert-danger'>
								   Please fillup.
							  </div>";		   
								}
								 else{
							  $register = "INSERT INTO meal(mealinput,timeinput,dateinput,member_id) VALUES ('$meal','$time','$date','$userid')";
							  $result   = mysqli_query($connect,$register);
							  echo "<div class='alert alert-success'>
						  <strong>Success!</strong> Thank you.
						</div>";
            echo "<script>setTimeout(\"location.href = 'user.php';\",1500);</script>";
						
						  }
							   }
							?>
                            <div class="form-group">
                                <label for="mealinput">Total Meal:</label>
                                <input type="text" name="mealinput" class="form-control" id="mealinput">
                            </div>
                            <div class="form-group">
                                <label for="day">Select</label>
                                <input type="radio" name="option" value="Day">Day
                                <input type="radio" name="option" value="Night">Night
                     
                            </div>
							
							<br>
                            <button type="submit" name="meal_create" class="btn btn-default">Submit</button>
						
                        </form>
							<br>
							<div class="panel-heading">
                             Thanks for using
                           </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<!-- Morris Charts JavaScript -->
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script>
</body>
</html>
