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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell" aria-hidden="true">
					           
				        	
					</i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                               <?php
							    $date=date("l jS \ F Y ");
								$mealsel = "SELECT meal.member_id,member.name,member.image,meal.dateinput,
								meal.mealinput,meal.timeinput
								FROM meal,member
								Where member.id=meal.member_id
								AND meal.dateinput = '$date'
								GROUP BY member_id";
								$runmeal = mysqli_query($connect,$mealsel);
								while($row=mysqli_fetch_assoc($runmeal)){
								?>
                        <li class="message-preview">
                            <a href="meal_request.php?id=<?php echo $row['member_id']; ?>&name=<?php echo $row['name'];?>">
                                <div class="media">
                                    <span class="pull-left">
                                        <img src='images/<?php echo $row['image'];?>' 
										alt="Smiley face" width="42" height="42">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong><?php echo $row['name'];?></strong>
                                        </h5>
										<?php echo $date; ?>
                                    </div>
                                </div>
                            </a>
                        </li>
						<?php } ?>		
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['username'];?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
              
                    
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i>Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
           <?php include('admin_sidebar.php'); ?>
        </nav>