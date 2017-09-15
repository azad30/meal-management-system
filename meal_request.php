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
    <div id="wrapper">
        <!-- Navigation -->
        <?php include('nav.php'); ?>
        <div id="page-wrapper">
            <div class="container-fluid">
           <div class="row">
                        <div class="col-md-12">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-9 text-right">
                                        <div class="text-center"><h3>Welcome to Meal System</h3></div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left"></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div> 
                </div>               
               <div class="table-responsive">
				     <h3><?php  
					 $date=date("l jS \ F Y "); 
					 echo $date.'Meal request';
					 ?></h3>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Member Name</th>
                                        <th>Meal</th>
										 <th>Time</th>
										 <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								if(isset($_GET['name'])){
								$id = $_GET['id'];
								$mealsel = "SELECT * FROM meal WHERE member_id=$id ORDER BY id DESC";
								$runmeal = mysqli_query($connect,$mealsel);
								while($row=mysqli_fetch_assoc($runmeal)){
								?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                         <td><?php  echo $_GET['name']; ?></td>
                                        <td><?php echo $row['mealinput']; ?></td>
										<td><?php echo $row['timeinput']; ?></td>
										<td><?php echo $row['dateinput']; ?></td>
										<td><a href="member-update.php?id=<?php echo $row['id']; ?>"><i class="fa fa-pencil" 
										aria-hidden="true"></i> Edit</a>
										<a href="member-delete.php?id=<?php echo $row['id']; ?>"><i class="fa fa-trash" 
										aria-hidden="true"></i> Delete</a></td>
                                    </tr>
								<?php } }?>	
                                </tbody>
                            </table>
                        </div>
				 <div class="row">
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Tasks Panel</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <span class="badge">just now</span>
                                        <i class="fa fa-fw fa-calendar"></i> Calendar updated
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">4 minutes ago</span>
                                        <i class="fa fa-fw fa-comment"></i> Commented on a post
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">23 minutes ago</span>
                                        <i class="fa fa-fw fa-truck"></i> Order 392 shipped
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">46 minutes ago</span>
                                        <i class="fa fa-fw fa-money"></i> Invoice 653 has been paid
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">1 hour ago</span>
                                        <i class="fa fa-fw fa-user"></i> A new user has been added
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">2 hours ago</span>
                                        <i class="fa fa-fw fa-check"></i> Completed task: "pick up dry cleaning"
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">yesterday</span>
                                        <i class="fa fa-fw fa-globe"></i> Saved the world
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">two days ago</span>
                                        <i class="fa fa-fw fa-check"></i> Completed task: "fix error on sales page"
                                    </a>
                                </div>
                                <div class="text-right">
                                    <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div>
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
