
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');
        $id = $_GET['id'];

    ?>
    <div class="team_section layout_padding">
      <div class="">
        <h1 class="what_taital">View Client</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Client Details</b></h3>
                <hr>
                <?php
                    $lastList_sql = "SELECT a.client_id, a.name, a.address, a.gender, a.phone, a.phone2, a.date FROM clients a  WHERE client_id ='{$id}'";
                    $lastList_query = mysqli_query($db_connect, $lastList_sql);
                    $lastList_rs = mysqli_fetch_assoc($lastList_query);
                    $client_id = $lastList_rs['client_id'];
                    $name = $lastList_rs['name'];
                    $address = $lastList_rs['address'];
                    $gender = $lastList_rs['gender'];
                    $phone = $lastList_rs['phone'];
                    $phone2 = $lastList_rs['phone2'];
                    $date = $lastList_rs['date'];


                ?>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Client ID :</label></b>
                                <?php echo $client_id ; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Client Name :</label></b>
                                <?php echo $name ; ?>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Address :</label></b>
                                <?php echo $address ; ?>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Gender :</label></b>
                                <?php echo $gender ; ?>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Phone Number :</label></b>
                                <?php echo $phone ; ?>
                            </div> 
                        </div>  
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Alternative Phone Number :</label></b>
                               <?php echo $phone2 ; ?>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Date :</label></b>
                                <?php echo $date ; ?>
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
        window.location.href = 'dashboard.php?page=pages/delete_clients_process&id=' + id;
    } 
}
</script>