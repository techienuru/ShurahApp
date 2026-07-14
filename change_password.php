 <!DOCTYPE html>
<html lang="en">
<head>
<!-- basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- mobile metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<!-- site metas -->
<title>Shurah | Super Stores</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content=""> 
<!-- bootstrap css -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="js/dist/css/select2.min.css">
<link rel="icon"  href="images/favicon.png">
<!-- style css -->
<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet"  href="jquery.dataTables.min.css">		
    <link rel="stylesheet" href="js/bootstrap.min.js">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" type="text/javascript"></script> 	
    <script src="jquery.dataTables.min.js" type="text/javascript"></script> 
</head>
<body>
  <!--header section start -->
    <div class="header_section header_bg">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="logo"><a href="pages/add_products.php"><img src="images/logo1.png"></a></div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <!--<li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages/view_products.php">Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="create_loan.php">Create new Loan</a>
              </li>-->
            </ul>
          </div>
        </nav>
    </div>
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');

    ?>
    <div class="team_section layout_padding">
        <div class="">
                    <?php
                            if(!empty($_GET['success'])){
                                //echo "success";
                                ?>
                                <div class="row"> 
                                    <div class="col-md-7 alert alert-primary" style="margin-top: 42px; margin-left:380px;"><h4><?php echo $_GET['success']; ?></h4></div>
                                </div>
                                <?php
                            }if(!empty($_GET['error'])){
                                ?>
                                <div class="row"> 
                                    <div class="col-md-7 alert alert-danger" style="margin-top: 42px; margin-left:380px;" ><?php echo $_GET['error']; ?></div>
                                </div>
                            <?php
                            }else{
                                //
                            }
                        ?>
        </div>
      <div class="">
        <h1 class="what_taital">Change Password</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Password Details</b></h3>
                <hr>
<?php 
  $error = $_GET['error'];
  $success = $_GET['success'];
  $username = $_GET['username'];
?>
<div class="container">
    <h1 class="text-center">Change Password</h1>
    <div class="box">
        <hr>
        <form action="create_change_user_password.php" method="post">
            <h6 class="mb-2 text-primary">Change Password</h6>
            <div class="row">
                <div class="col-6">
                   <div class="form-group">
                        <label>User Name:</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="User Name" value="<?php echo $username; ?>" readonly>
                    </div>
                   <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                </div>                
                <div class="col-6" style="margin-top: 90px;">
                   <div class="form-group">
                        <label>Confirm Password:</label>
                        <input type="password" class="form-control" name="confirm_password" id="password" placeholder="Confirm Password">
                    </div>   
                </div>
            </div>
        <button type="submit" class="btn btn-info" id="save" name="submit" >Change Password</button>
        </form>
    </div>
    
    <div class="box">
        <div class="row">
            <div class="col-12">
                <?php
                if(empty($error) && empty($success) && !empty($username)){
                    
                }else{
                if(empty($username)){
                    if(empty($error)){
                    echo "<div class='alert alert-success' role='alert'>";
                    echo $success." You can sign in now.";
                    echo "<br>";        
                    echo "</div>";
                 }else{
  
                 };
                }else if(!empty($username) && empty($success)){
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo $error;
                    echo "<br>";        
                    echo "</div>";  
                }
                }
                ?>
                <hr>

            <button type="button" class="btn btn-danger"><a class="log" href="logout.php">Sign In</a></button>  
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
        </div>
      </div>

    <!--team section end -->
    <!--footer section start -->
    <?php 
        //include('footer.php');
    ?>
    <!--footer section end -->
    <!-- Javascript files-->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/dist/js/jquery-3.6.0.min.js"></script>
    <script src="js/dist/js/select2.min.js"></script>

</body>

</html>
<style>
    .form-control{
        border: 1px dotted;
    }
</style>
<script>
$(document).ready(function(){
    $('#category_id').select2();
    
    $('#but_read').click(function(){
    var username=$('#category_id option:selected').text();
    var userid = $('#category_id').val();
        
    //$('#result').html("id:" + userid + ",name:" +username);
    });
});
</script>
<script>
$(document).ready(function(){
    $('#supp_id').select2();
    
    $('#but_read').click(function(){
    var username=$('#supp_id option:selected').text();
    var userid = $('#supp_id').val();
        
    //$('#result').html("id:" + userid + ",name:" +username);
    });
});
</script>
<script type="text/javascript">
    function multi(){
        var qty = document.getElementById('qty').value;
        var cart_qty = document.getElementById('cart_qty').value;
        var result = parseInt(qty) * parseInt(cart_qty);
        if(!isNaN(result)){
            document.getElementById('pcs').value = result;
        }
    }

</script>