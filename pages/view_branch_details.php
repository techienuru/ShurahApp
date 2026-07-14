
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');
        $id = $_GET['id'];

    ?>
    <div class="team_section layout_padding" style="margin-top: -100px">
      <div class="">
        <h1 class="what_taital">View Branch</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Branch Details</b></h3>
                <hr>
                <?php
                    $lastList_sql = "SELECT a.branch_id, a.branch_name, a.activation_id FROM branch a  WHERE a.branch_id =".$id ;
                    $lastList_query = mysqli_query($db_connect, $lastList_sql);
                    $lastList_rs = mysqli_fetch_assoc($lastList_query);
					if(empty($lastList_rs)){
						
					}else{
						$branch_id = $lastList_rs['branch_id'];
						$branch_name = $lastList_rs['branch_name'];
						$activation_id = $lastList_rs['activation_id'];
					}
                ?>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Branch ID :</label></b>
                               <?php echo $branch_id ; ?>
                            </div>
                        </div>                      
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Branch Name :</label></b>
                               <?php echo $branch_name ; ?>
                            </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Activation Status  :</label></b>
                               <?php echo strtoupper($activation_id) ; ?>
                            </div>
                        </div>                         

                    </div>
                     <hr>
                    <div class="text-right">
                        <div class="form-group">
                            <div class="text-right">
                                <a href="dashboard.php?page=pages/view_branch" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
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

</body>

</html>
<style>
    .form-control{
        border: 1px dotted;
    }

</style>