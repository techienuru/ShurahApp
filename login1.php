<?php
    include('includes/links.php');
?>
<body>
  <!--header section start -->
    <div class="header_section header_bg">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="logo"><a href="index.php"><img src="images/logo1.png"></a></div>
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
</div> 
    <div class="services_section layout_padding">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <h1 class="services_taital">WELCOME TO SOLARCAM TECHNOLOGY </h1>
              <P>EVERYTHING RENEWABLE ENERGY AND SECURITY SURVEILANCE</P>
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
                          <input type="password" name="password" class="mail_text_1" placeholder="Password" required />
                        </div>
                          <button type="submit" name="submit" class="send_bt"><a>Submit</a></button>
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