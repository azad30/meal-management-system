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
                <!-- Page Heading -->
					<div class="row">
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
                <div class="row">
				      <h3>Member Total meal</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Member Name</th>
                                    <th>Total Meal</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $deposit = "SELECT meal.member_id,member.name,SUM(mealinput)
                                FROM meal,member
                                WHERE member.id=meal.member_id
                                GROUP BY member_id";
                                $rundeposit = mysqli_query($connect,$deposit);
                                while($row=mysqli_fetch_assoc($rundeposit)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['SUM(mealinput)']; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                           </div>
			          </div>
				  <h3>Meal Rate</h3>
				  <table class="table table-bordered">
									<thead>
									  <tr>
										<th>Meal Rate</th>
									  </tr>
									</thead>
									<tbody>
								<?php
								$total = "SELECT * 
                                FROM meal_rate ORDER BY id DESC";
								$rundeposit = mysqli_query($connect,$total);
								while($row=mysqli_fetch_assoc($rundeposit)){
								?>
								  <tr>
									<td><?php echo $row['mealrate'];?></td>
								  </tr>
								<?php } ?>	
								</tbody>
							  </table>
							<h3>Member Total Money Deposite</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Member Name</th>
                                    <th>Total Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $deposit = "SELECT deposit_money.id,deposit_money.amount, deposit_money.member_id,member.name,SUM(amount)
                                            FROM deposit_money,member
                                            WHERE member.id=deposit_money.member_id
                                            GROUP BY member_id";
                                $rundeposit = mysqli_query($connect,$deposit);
                                while($row=mysqli_fetch_assoc($rundeposit)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['SUM(amount)']; ?></td>
                                    </tr>
                                <?php } ?>
							
                                </tbody>
                            </table>
                          </div>
						 <?php
							if(isset($_POST['calc'])){
								$member =$_POST['member'];
								$totalmeal= $_POST['tm'];
								$mealrate=$_POST['meal_rate'];
								$mul = $totalmeal * $mealrate;
								$market =$_POST['mm'];
								$giveorgot=$market-$mul;
								
								if(empty($member)){
								echo "<div class='alert alert-danger'>
								   Please fillup.
							  </div>";		   
								}
								if(empty($totalmeal)){
								echo "<div class='alert alert-danger'>
								   Please fillup.
							  </div>";		   
								}
								if(empty($mealrate)){
								echo "<div class='alert alert-danger'>
								   Please fillup.
							  </div>";		   
								}
								if(empty($market)){
								echo "<div class='alert alert-danger'>
								   Please fillup.
							  </div>";		   
								}
								 else{
							  $register = "INSERT INTO member_total_meal(member_id,total_meal,meal_rate,tm_into_meal_rate,total_market,total_deposit,give_or_got_money) VALUES ('$member','$totalmeal','$mealrate','$mul','$market','$giveorgot')";
							  $result   = mysqli_query($connect,$register);
							  echo "<div class='alert alert-success'>
						  <strong>Success!</strong> Thank you.
						</div>";
            echo "<script>setTimeout(\"location.href = 'member_money_calc.php';\",1500);</script>";
						
						        }

							   }
							?>


                            <?php 




                            ?>
						  
						  <h1>Member final money calculation</h1>
						  
						  <table class="table table-bordered table-responsive">
							<thead>
							  <tr>
								<th>Member</th>
								<th>Meal</th>
								<th>Meal Rate</th>
								<th>Total Cost</th>
								<th>Total Bazar</th>
                                <th>Deposit</th>
								<th>Pay / Return</th>
							  </tr>
							</thead>
                                <?php
                                $mmc = "SELECT member_total_meal.member_id,member_total_meal.total_meal,member_total_meal.meal_rate,member_total_meal.tm_into_meal_rate,member_total_meal.total_market,member_total_meal.give_or_got_money,member.name,deposit_money.amount, SUM(amount)
                                            FROM member_total_meal,member, deposit_money
                                            WHERE member.id=member_total_meal.member_id AND member.id = deposit_money.member_id
                                            GROUP By member_id";
                                $runmmc = mysqli_query($connect,$mmc);
                                while($row=mysqli_fetch_assoc($runmmc)){
									$totalCost    = $row['tm_into_meal_rate'];
                                    $totalDeposit = $row['SUM(amount)'];
									$sm   =$row['total_market'];
                                 ?>

							<tbody>
							  <tr>
								<td><?php echo $row['name']; ?></td>
									<td><?php echo $row['total_meal']; ?></td>
									<td><?php echo $row['meal_rate']; ?></td>
									<td><?php echo $row['tm_into_meal_rate']; ?></td>
									<td><?php echo $row['total_market']; ?></td>
                                    <td><?php echo $row['SUM(amount)']; ?></td>

								  <td>
								      <?php
									   if($totalDeposit > $totalCost){
										  echo $row['name'].'&nbsp'.'Got'.'&nbsp' .($totalDeposit-$totalCost).'&nbsp'.'Taka';
										  echo '&nbsp'.'<i class="fa fa-smile-o" aria-hidden="true" style="font-size:20px;"></i>';
									   }else{
										   echo $row['name'].'&nbsp'.'Give'.'&nbsp' .($totalCost-$totalDeposit).'&nbsp'.'Taka';
										    echo '&nbsp'.'<i class="fa fa-frown-o" aria-hidden="true" style="font-size:20px;"></i>';
									   }
									  ?>
								   </td>
							   <tr>
							</tbody>
								<?php } ?>
						  </table>
						     <form method="POST" action="">
							 <label for="mealinput">select Member:</label>
								<select name="member" class="form-control" id="selectMember">
                                 <option value="0" name="member" selected="true" disabled="true">select member</option>
								  <?php
									$mealsel = "SELECT * FROM member";
									$runmeal = mysqli_query($connect,$mealsel);
									while($row=mysqli_fetch_assoc($runmeal)){
									?>
								  <option value="<?php echo $row['id'];?>"><?php echo $row['name']; ?></option>
								  	<?php } ?>
								</select>
								   <div class="form-group">
                                     <label for="mealinput">Total Meal:</label>
                                      <input type="text" name="tm" class="form-control" id="mealinput" readonly>
                                   </div>
								    <div class="form-group">
                                     <label for="mealinput">Meal Rate:</label>
                                    <?php
                                    $meal_rate        = "SELECT mealrate FROM meal_rate";
                                    $member_meal_rate = mysqli_query($connect,$meal_rate);
                                    $row=mysqli_fetch_assoc($member_meal_rate);
                                    ?>
                                      <input type="text" name="meal_rate" class="form-control" id="mealinput" value="<?php echo $row['mealrate']; ?>" readonly>
                                            
                                   </div>
								     <div class="form-group">
                                     <label for="totalbazar">Member total market:</label>
                                      <input type="text" name="mm" class="form-control" id="totalbazar" readonly>
                                   </div>
								   <input type="submit" name="calc" class="btn btn-default" value="Calculate">
						  </form>
						  <br>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                            <script type="text/javascript">

                                $(document).ready(function(){

                                    $(document).on('change','#selectMember',function(){
                                    var member_id = $(this).val();
                                    var a=$(this).parent();
                                    $.ajax({
                                        type:"POST",
                                        url :"getMeal.php",
                                        data:{'id':member_id},
                                        success : function(data, textStatus, request){
                                            a.find('#mealinput').val(data);
                                        },
                                        error : function(){
                                            console.log("data missing");
                                        }
                                    });
                                });


                                    $(document).on('change','#selectMember',function(){
                                    var member_id = $(this).val();
                                    console.log(member_id);
                                    var a=$(this).parent();
                                    $.ajax({
                                        type:"POST",
                                        url :"getBazar.php",
                                        data:{'id':member_id},
                                        success : function(data, textStatus, request){
                                            a.find('#totalbazar').val(data);
                                            //console.log("success");
                                        },
                                        error : function(){
                                            console.log("data missing");
                                        }
                                    });
                                });



                            });
                                

                          </script>



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
                                        <span class="badge">yesterday</span>
                                        <i class="fa fa-fw fa-globe"></i> Saved the world
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">two days ago</span>
                                        <i class="fa fa-fw fa-check"></i> Completed task: "fix error on sales page"
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
                <!-- /.row -->
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
