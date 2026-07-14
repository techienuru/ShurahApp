<?php
    include('includes/links.php');
    include_once('includes/db_connect.php');
?>
<body>
  <!--header section start -->
    <div class="header_section header_bg">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="logo"><a href="index.php"><img src="images/shurah_logo3.png"></a></div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>
            </ul>
          </div>
        </nav>
    </div>
    <!--header section end -->
    <!--about section start -->
    <div class="team_section layout_padding">
    <div class="container2">
        <?php if (!empty($_GET['success'])): ?>
            <div class="row">
                <div class="col-12 alert alert-primary text-center" style="margin-top: 20px;">
                    <h4><?php echo $_GET['success']; ?></h4>
                </div>
            </div>
        <?php elseif (!empty($_GET['error'])): ?>
            <div class="row">
                <div class="col-12 alert alert-danger text-center" style="margin-top: 20px;">
                    <?php echo $_GET['error']; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <!-- Rest of the code -->
<?php
		//sql for address
		$company_details_sql = "SELECT * FROM company_details";
		$company_details_query = mysqli_query($db_connect, $company_details_sql);
		$company_details_List_rs = mysqli_fetch_assoc($company_details_query);
		$company_name = $company_details_List_rs['company_name'];
		$motto = $company_details_List_rs['motto'];
		$address1 = $company_details_List_rs['address1'];
		$address2 = $company_details_List_rs['address2'];
		$phone_no1 = $company_details_List_rs['phone_no1'];
		$phone_no2 = $company_details_List_rs['phone_no2'];
		$email = $company_details_List_rs['email'];
		$website = $company_details_List_rs['website'];		
?>
</div> 
    <div class="services_section layout_padding">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <h1 class="services_taital">WELCOME TO <?php echo $company_name; ?> </h1>
              <p><?php echo $motto ; ?></p>
          </div>
          <div class="col-md-4">
            <!--<div><img src="images/img-1.png" class="image_1"></div>-->
              <div class="container">
                  <div class="box">
                      <form action="process_login.php" method="post">
                     <div class="row">
                        <div class="form-group">
                            <input type="text" class="mail_text_1" placeholder="Username" name="username" required autofocus>
                        </div> 
                        <div class="form-group">
                          <input type="password" name="password" class="mail_text_1 js-password-box" placeholder="Password" required />
                        </div>
			<div class="form-group mt-2">
                          <input type="checkbox" name="password" class="js-show-password"/>
			  <label>Show Password</label>
                        </div>
                          <button type="submit" name="submit" class="send_bt"><a>Login</a></button>
                    </div>                                           
                     </form>
                  </div>          
              </div>
          </div>
        </div>
      </div>
    </div>
    <!--about section end -->
    <!--footer section start -->
    <?php 
        //include('footer.php');
    ?>
    <!--footer section end -->
    <!-- Javascript files-->
    <script>
	<!-- Toggle Show Password -->
	const shwPwdElem = document.querySelector(".js-show-password");
	const pwdInputElem = document.querySelector(".js-password-box");
	
	shwPwdElem.addEventListener("change", (e)=>{
		if(e.currentTarget.checked){
			pwdInputElem.type = "text";
		}else{
			pwdInputElem.type = "password";
		}
	})
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- javascript --> 
    <script src="js/owl.carousel.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script> 
</body>
</html>