
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');
        $id = $_GET['id'];

    ?>
    <div class="team_section layout_padding">
      <div class="">
        <h1 class="what_taital">Expense sub head</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Sub Head Details</b></h3>
                <hr>
                <?php
                    $lastList_sql = "SELECT * FROM expence_sub_head WHERE expence_code='{$id}'";
                    $lastList_query = mysqli_query($db_connect, $lastList_sql);
                    $lastList_rs = mysqli_fetch_assoc($lastList_query);
                    $expence_code = $lastList_rs['expence_code'];
                    $category_name = $lastList_rs['expence_name'];
                ?>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Expense Code :</label></b>
                               <?php echo $expence_code ; ?>
                            </div>
                        </div>                      
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Expense Name :</label></b>
                               <?php echo $category_name ; ?>
                            </div>
                        </div>                                       
                    </div>
                     <hr>
                    <br>
                    <div class="text-right">
                        <div class="form-group">
                            <div class="text-right">
                                <?php
                                echo "<a href='#' onclick='confirmDelete({$id});'  class='btn btn-xs btn-danger'>Delete Record</a>";
                                ?>
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
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/dist/js/jquery-3.6.0.min.js"></script>

</body>

</html>
<style>
    .form-control{
        border: 1px dotted;
    }
</style>
<script>
// confirm record deletion
function confirmDelete( id ){
    if(confirm('Are you sure you want to delete this record?')){
                //if user click OK execute the delete action
        window.location.href = 'dashboard.php?page=pages/delete_expense_sub_head_process&id=' + id;
    } 
}
</script>