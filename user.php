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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
					         <?php
								$userid= $_SESSION['id'];
								$mealsel = "SELECT * FROM member WHERE id='$userid' LIMIT 1";
								$runmeal = mysqli_query($connect,$mealsel);
								while($row=mysqli_fetch_assoc($runmeal)){
								?>
								<img src='images/<?php echo $row['image'];?>' alt="Smiley face" width="42" height="42">
								<?php } ?>
					<?php echo $_SESSION['username'];?> <b class="caret"></b></a>
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
            <div class="container col-lg-12">
			<br>
						<div class="panel panel-default">
							 <div class="panel-body">Welcome:<span style="color:red;"> <?php echo $session_id=$_SESSION['username']; ?><span></div>
						</div>
				<div class="table-responsive col-lg-12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Meal No</th>
                                        <th>Time</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								$userid= $_SESSION['id'];
								$mealsel = "SELECT * FROM meal WHERE member_id='$userid'";
								$runmeal = mysqli_query($connect,$mealsel);
								while($row=mysqli_fetch_assoc($runmeal)){
								?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['mealinput']; ?></td>
                                        <td><?php echo $row['timeinput']; ?></td>
                                        <td><?php echo $row['dateinput']; ?></td>
                                    </tr>
								<?php } ?>	
                                </tbody>
                            </table>
                        </div>
						<div class="col-md-6">
						<div class="table-responsive">
						Your Total meal
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Total Meal</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								$userid= $_SESSION['id'];
								$mealsel = "SELECT SUM(mealinput)FROM meal
								WHERE member_id='$userid'";
								$runmeal = mysqli_query($connect,$mealsel);
								while($row=mysqli_fetch_assoc($runmeal)){
								?>
                                    <tr>
                                        <td><?php echo $row['SUM(mealinput)']; ?></td>
                                    </tr>
								<?php } ?>	
                                </tbody>
                            </table>
                        </div>
						</div>
						<div class="col-md-6">
						<div class="table-responsive">
						Your Total Market
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Total Market</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								$userid= $_SESSION['id'];
								$mealsel = "SELECT SUM(amount)FROM deposit_money
								WHERE member_id='$userid'";
								$runmeal = mysqli_query($connect,$mealsel);
								while($row=mysqli_fetch_assoc($runmeal)){
								?>
                                    <tr>
                                        <td><?php echo $row['SUM(amount)'].'&nbspTaka'; ?></td>
                                    </tr>
								<?php } ?>	
                                </tbody>
                            </table>
                        </div>
						</div>
                <div class="row container">
                            <div class="col-lg-3 col-md-6">
                                <div class="row">
                                    <div class="col-xs-3">
										<a class="text-center fa fa-plus-square btn btn-info" style="color:#000000;padding:10px 5px;" href="meal-form.php">
                                     Meal Request</a>
                                    </div>
                                </div>
                            </div>
                       </div>
                   </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
</body>
</html>
