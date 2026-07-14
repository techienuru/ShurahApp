<?php
    ob_start();
    include("includes/sessions.php"); 
    include("functions/functions.php");
    include_once('includes/db_connect.php');
    $rnd =  createthree();
    confirm_logged_in();
    auto_logout();

    if(!isset($_SESSION['admin'])){
        header('location:login.php');
    }
    $date = date('Y-m-d');
    //$current_time = time();
    //$time_string = date("YmdHis", $current_time);
    $user = $_SESSION['admin'];
    $user_iid = $_SESSION['user_id'];
    $branch_iid = $_SESSION['branch_iid'];

    $sql = "SELECT * FROM users WHERE user_id=".$user_iid;
    $user_query = mysqli_query($db_connect, $sql);
    $userList_rs = mysqli_fetch_assoc($user_query);
    $role = $userList_rs['role'];
 
    $query = "SELECT COUNT(client_id) AS Total_No_of_Client FROM clients";
    $querylist = mysqli_query($db_connect,$query);
    $queryresult = mysqli_fetch_assoc($querylist);
    $total_client = $queryresult['Total_No_of_Client']; 

    $query1 = "SELECT COUNT(user_id) AS users FROM users";
    $querylist1 = mysqli_query($db_connect,$query1);
    $queryresult1 = mysqli_fetch_assoc($querylist1);
    $users = $queryresult1['users']; 

    $query2 = "SELECT COUNT(prod_id) as products FROM product";
    $querylist2 = mysqli_query($db_connect,$query2);
    $queryresult2 = mysqli_fetch_assoc($querylist2);
    $total_products = $queryresult2['products'];  

	$query22 = "SELECT COUNT(a.prod_id) as exp_product FROM product a LEFT JOIN category b ON a.category_id = b.category_id WHERE `expiration` BETWEEN now() AND date_add(now(), INTERVAL 3 month)";
    $querylist22 = mysqli_query($db_connect,$query22);
    $queryresult22 = mysqli_fetch_assoc($querylist22);
    $total_product_with_3_months_expiration = $queryresult22['exp_product'];  


    $prodList_sql = "SELECT COUNT(a.prod_id) AS prod_id, a.prod_code, b.category_name, a.prod_name, a.qty_left FROM product a LEFT JOIN category b ON a.category_id = b.category_id WHERE b.category_name IS NOT NULL AND a.qty_left < 20";
    $prodList_query = mysqli_query($db_connect, $prodList_sql);
    $prodList_rs = mysqli_fetch_assoc($prodList_query);
    $re_stock = $prodList_rs['prod_id'];
    
    $lastList_sql3 = "SELECT SUM(a.amount) as total_daily_expense FROM expence_table a WHERE a.date = '{$date}'";
    $user_query3 = mysqli_query($db_connect, $lastList_sql3);
    $userList_rs3 = mysqli_fetch_assoc($user_query3);
    $total_daily_expense = $userList_rs3['total_daily_expense'];

	$lastList_sql = "SELECT SUM(cash) as cash, SUM(pos) AS pos, SUM(transfer) as transfer 
	FROM sales WHERE date ='{$date}'";
	$lastList_query = mysqli_query($db_connect, $lastList_sql);
	$lastList_rs = mysqli_fetch_assoc($lastList_query);
	$total_cash = $lastList_rs['cash'];
	$total_pos = $lastList_rs['pos'];
	$total_transfer = $lastList_rs['transfer'];
	$total_transaction = $total_cash + $total_pos + $total_transfer;



?> 
<?php
if($role == 'admin'){
  include("includes/header.php");  
}elseif($role == 'cashier'){
    include("includes/sales_header.php");
}elseif($role == 'manager'){
    include("includes/manager_header.php");
}else{
    include("includes/stock_header.php");
}
 
?>
<!--<h1 class="what_taital" style="margin-top: 10px;"><?php echo greeting()." "." and welcome ".$user;?> </h1>-->
    <!--<div class="row" style="float:right">
        <h5 style="margin-right:-156px;margin-top:-5px; float: right;"><p style="color:#FF6600"><?php echo greeting()." ".", and ";?>welcome <strong><?php echo strtoupper($user) ?></strong></p></h5>	
        <h5 style="margin-right:36px;margin-top:-55px; float: left;"><p style="color:blue;">Branch Name: <strong><?php echo strtoupper($branch_name);?></strong></p></h5>
     </div>-->
	<div style="flex:1">
    <b style="margin-right:-6px;margin-top:-5px; float: left;"><p style="color:#62BC58"><?php echo greeting()." ".", and ";?>welcome!!. </p></b>    
    <b style="margin-right:-6px;margin-top:-5px; float: right;"><p style="color:#62BC58"><strong><?php echo "Role : "." ". strtoupper($role). " "." Username: ". strtoupper($user) ?></strong></p></b>    
	</div>
<br>
<br>
<br>
    <!--header section end -->
    <!--team section start -->
    <div class="team_section layout_padding">
      <div class="container">

        <div class="team_section_2 layout_padding" style="margin-top: -250px;">
            <?php
                //include('includes/display.php');
                if(!isset($_GET['page'])){
                    echo "<h1 class='what_taital' style='margin-top: 10px;'>Dashboard </h1>";
					$sql = "SELECT * FROM users WHERE user_id=".$user_iid;
					$user_query = mysqli_query($db_connect, $sql);
					$userList_rs = mysqli_fetch_assoc($user_query);
					$role = $userList_rs['role'];
					if($role == "admin"){
						include("includes/display.php");
					}elseif($role == "manager"){
						include("includes/display.php");
					}else{
                      include("includes/display_other.php");  
                    }                  
                } else {
                    $page =$_GET['page'];
                    include("$page.php");
                }

            ?>
        </div>
      </div>
    </div>
    <!--team section end -->
    <!--footer section start -->
    <!--footer section end -->
    <!-- Javascript files-->

    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- sidebar -->

</body>
</html>
<script>
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;
    for (i = 0; i < dropdown.length; i++){
        dropdown[i].addEventListener("click", function(){
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if(dropdownContent.style.display === "block"){
                dropdownContent.style.display = "none";
            }else{
                dropdownContent.style.display = "block";
            }
        });
    }
</script>
    <style type="text/css">
    body{
        background-color: #ffffff; 
    }
    .container{
        margin-top: 30px;   
    }
    .box{
        background-color: aliceblue;
        padding: 30px;
        margin-bottom: 20px;
        margin-top: 5%;
    }
    .form-group{
        margin-bottom: 10px;
        margin-top: 10px;
    }
    .alert{
        margin-left: 0.5%;
    }
</style>