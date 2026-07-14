
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');
        $id = $_GET['id'];

    ?>
    <div class="team_section layout_padding" style="margin-top: -100px">
      <div class="">
        <h1 class="what_taital">Expense Reversal View</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Reversal Details</b></h3>
                <hr>
                <?php
                    $lastList_sql = "SELECT a.date, a.expence_id, c.expence_name, a.description, a.amount, b.username FROM expence_table a LEFT JOIN users b ON a.user_id = b.user_id LEFT JOIN expence_sub_head c ON c.expence_code = a.expence_code  WHERE a.expence_id =".$id ;
                    $lastList_query = mysqli_query($db_connect, $lastList_sql);
                    $lastList_rs = mysqli_fetch_assoc($lastList_query);
                    $date = $lastList_rs['date'];
                    $expence_id = $lastList_rs['expence_id'];
                    $expence_name = $lastList_rs['expence_name'];
                    $amount = $lastList_rs['amount'];
                    $username = $lastList_rs['username'];

                ?>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Transaction Date :</label></b>
                               <?php echo $date ; ?>
                            </div>
                        </div>                      
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Expense ID :</label></b>
                               <?php echo $expence_id ; ?>
                            </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Expense Name  :</label></b>
                               <?php echo strtoupper($expence_name) ; ?>
                            </div>
                        </div>                         
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Reversal Amount :</label></b>
                               <?php echo $amount ; ?>
                            </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Username :</label></b>
                            <?php echo strtoupper($username); ?> 
                            </div>
                        </div>
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Reversed On :</label></b>
                               <?php echo $date ; ?>
                            </div>
                        </div>
                    </div>
                     <hr>
					<div class="col-6">
						<div class="form-group">
							<b><label>Reversal reason(s) :</label></b>
							<input class="form-control" type="text" id="reversal_reason" name="reversal_reason" value="" placeholder="Enter Reversal reason" required>
						</div>
					</div>
                    <div class="text-right">
                        <div class="form-group">
                            <div class="text-right">
                                <?php
                                echo "<a href='#' onclick='confirmDelete({$id});'  class='btn btn-xs btn-danger'>Reverse Transaction</a>";
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
    <script src="js/bootstrap.bundle.min.js"></script>

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
		var reason = document.getElementById('reversal_reason').value;
		if(reason === ""){
			alert("Please fill in reversal reasons.");
        	return;
		}
		var result = confirm('Are you sure you want to reverse this transaction?');
	
	    if (result) {
        // Collect form data
        var formData = new FormData(document.querySelector('form'));

        // Create URL-encoded query string from the form data
        var queryString = new URLSearchParams(formData).toString();
        
        // Redirect to the target page with the client ID and form data as query parameters
        window.location.href = 'dashboard.php?page=pages/delete_expense_process&id=' + id + '&' + queryString;
    }
    /*if(confirm('Are you sure you want to reverse this transaction?')){
                //if user click OK execute the delete action
        window.location.href = 'dashboard.php?page=pages/delete_expense_process&id=' + id;
    }*/ 
}
</script>