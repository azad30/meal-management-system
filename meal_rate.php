<?php
session_start();
if (!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
    header("location: login.php");
    exit();
}
$session_id=$_SESSION['username'];
?>
<?php include('header.php'); ?>
<body onload = "mealRateCalculate()">
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
				   <h1>Meal rate calculation</h1>

                   <?php

                        if (isset($_POST['submit'])) {
                            $totalMeal  = $_POST['total_meal'];
                            $totalbazar = $_POST['total_market'];
                            $mealrate   = $_POST['mealRate'];
                            $date = date("Y/m/d");

                            $register = "INSERT INTO meal_rate(total_market,total_meal,mealrate,date)VALUES('$totalbazar','$totalMeal','$mealrate','$date')";
                            $result   = mysqli_query($connect,$register);
                        }

                   ?>
                   
               
                    <div class="row">
                        <form method="POST" action="">
                           <?php
                        $totalMeal  = "select SUM(mealinput) from meal";
                        $total_meal = mysqli_query($connect,$totalMeal);
                        $row        = mysqli_fetch_assoc($total_meal);
        
                        $totalBazar   = "select SUM(amount) from bazar_money";
                        $total_Bazar  = mysqli_query($connect,$totalBazar);
                        $row1         = mysqli_fetch_assoc($total_Bazar);

                        $toalDepositMoney    = "select SUM(amount) from deposit_money";
                        $total_deposit       = mysqli_query($connect,$toalDepositMoney);
                        $row12                = mysqli_fetch_assoc($total_deposit);

                        ?>

                        <div class="form-group">
                                <label for="mealinput">Meal Rate:</label> 
                        <input type="text" class="form-control" name="mealRate" id="mealrate" value="" readonly />
                        </div>

                        <div class="form-group">
                                <label for="mealinput">Total Deposit:</label>
                                <input type="text" name="total_meal" class="form-control" id="totaldeposit" value="<?php echo $row12['SUM(amount)']; ?>" readonly>
                        </div>
                        <div class="form-group">
                                <label for="mealinput">Total Bazar:</label>
                                <input type="text" name="total_market" class="form-control" id="totalbazar" value="<?php echo $row1['SUM(amount)']; ?>" readonly>
                        </div>
                        <div class="form-group">
                                <label for="mealinput">Total Meal:</label>
                                <input type="text" name="total_meal" class="form-control" id="mealinput" value="<?php echo $row['SUM(mealinput)']; ?>" readonly>
                        </div>
                            <br>

                            <input type="submit" name="submit" class="btn btn-default" value="Record Save">

                    </form>
                </div>


                <script>
                   function mealRateCalculate(){
                        var totalMeal  = document.getElementById("mealinput").value;
                        var totalbazar = document.getElementById("totalbazar").value;
                        
                        document.getElementById("mealrate").value = totalbazar  / totalMeal;
                 }
                </script>


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
