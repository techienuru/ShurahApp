 
<!--header section start -->
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('Hms');
        $date = date('Y-m-d');

        $lastList_sql = "SELECT MAX(client_id) as last_id FROM clients";
        $lastList_query = mysqli_query($db_connect, $lastList_sql);
        $lastList_rs = mysqli_fetch_assoc($lastList_query);
        $last_id = $lastList_rs['last_id'];
        if(empty($last_id)){
           $last_id = 100000; 
        }else{
            $last_id = $lastList_rs['last_id']; 
        }
    ?>)
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
    <div class="team_section layout_padding"  style="margin-top: -100px">
      <div class="" style="">
        <h1 class="what_taital">Client Registration</h1>
        <p class="what_text_1"></p>
        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>Client Details</b></h3>
                <hr>
                <form action="dashboard.php?page=pages/process_add_clients" method="post">
                    <div class="row">
                        <div class="col-6">
                           <div class="form-group">
                                <b><label>Client ID :</label></b>
                                <input class="form-control" type="text" name="client_id" readonly value="<?php echo $last_id + 1 ; ?>">
                            </div>
                        </div>
						<div class="col-6">
                            <div class="form-group">
                                <b><label>Name :</label></b>
                                <input class="form-control" type="text" name="name" value="" placeholder="Enter Client Name" required>
                            </div>
                        </div>  
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Address:</label></b>
                                <input class="form-control" type="text" name="address" value="" placeholder="Enter Address" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Gender:</label></b>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="">--Select--</option>
                                    <option value="MALE">Male</option>
                                    <option value="FEMALE">Female</option>
                                </select>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Phone:</label></b>
                                <input class="form-control" type="text" id="phone" name="phone" value="" placeholder="Enter Phone Number" required>
                                <span id="phone1errorMessage" style="color:red;"></span>
                            </div>
                        </div> 
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Phone 2:</label></b>
                                <input class="form-control" type="text" id="phone" name="phone1" value="" placeholder="Enter alternative Phone Number">
                                <span id="phone2errorMessage" style="color:red;"></span>
                            </div>
                        </div> 
                        <div class="col-6">
                            <div class="form-group">
                                <b><label>Date :</label></b>
                                <input class="form-control" type="text" id="date" name="date" value="<?php echo $date ; ?>" readonly>
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                    <div class="text-right">
                        <div class="form-group">
                            <div class="text-right">
                                <button type="reset" id="reset" name="reset" class="btn btn-warning" onclick="reloadPage();">Reset</button>
                                <button type="submit" id="submit" name="submit" class="btn btn-primary">Save Profile</button>
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
</body>

</html>
<style>
    .form-control{
        border: 1px dotted;
    }

</style>
<script>
$(document).ready(function(){
    $('#state_id').select2();
    
    $('#but_read').click(function(){
    var username=$('#state_id option:selected').text();
    var userid = $('#state_id').val();
        
    //$('#result').html("id:" + userid + ",name:" +username);
    });
});
</script>
<script>
document.getElementById('email').oninput = function(){
    // Get the email input value 
    var emailValue = this.value;
    
    // Regular expression patten for email validation
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    // Get error message element
    var emailErrorMessageElement = document.getElementById('emailErrorMessage');
    
    // Check if the number of digits is not equal to 11
    if (!emailPattern.test(emailValue)){
        emailErrorMessageElement.textContent = "Please enter a valid email address.";
    } else {
       emailErrorMessageElement.textContent = ""; 
    }
};
</script>
<script>
document.getElementById('phone').oninput = function(){
    // Get the input value 
    var inputValue = this.value;
    
    // Remove non-numeric characters
    var numericValue = inputValue.replace(/[^0-9]/g, '');
    
    // Limit the number of digits to 
    numericValue = numericValue.slice(0, 11);
    
    // Update the input value
    this.value = numericValue;
    
    // Get error message element
    var errorMessageElement = document.getElementById('errorMessage');
    
    // Check if the number of digits is not equal to 11
    if (numericValue.length !== 11){
        errorMessageElement.textContent = "The phone number digits should be exactly 11.";
    } else {
       errorMessageElement.textContent = ""; 
    }
};
</script>
<script>
document.getElementById('bvn').oninput = function(){
    // Get the input value 
    var inputValue = this.value;
    
    // Remove non-numeric characters
    var numericValue = inputValue.replace(/[^0-9]/g, '');
    
    // Limit the number of digits to 
    numericValue = numericValue.slice(0, 11);
    
    // Update the input value
    this.value = numericValue;
    
    // Get error message element 
    var errorMessageElement = document.getElementById('bvnErrorMessage');
    
    // Check if the number of digits is not equal to 11
    if (numericValue.length !== 11){
        errorMessageElement.textContent = "The BVN digits should be exactly 11.";
    } else {
       errorMessageElement.textContent = ""; 
    }
};
</script>
<script>
document.getElementById('nims').oninput = function(){
    // Get the input value 
    var inputValue = this.value;
    
    // Remove non-numeric characters
    var numericValue = inputValue.replace(/[^0-9]/g, '');
    
    // Limit the number of digits to 
    numericValue = numericValue.slice(0, 11);
    
    // Update the input value
    this.value = numericValue;
    
    // Get error message element 
    var errorMessageElement = document.getElementById('nimsErrorMessage');
    
    // Check if the number of digits is not equal to 11
    if (numericValue.length !== 11){
        errorMessageElement.textContent = "The NIMS digits should be exactly 11.";
    } else {
       errorMessageElement.textContent = ""; 
    }
};
</script>
<script>
document.getElementById('year').oninput = function(){
    // Get the input value 
    var inputValue = this.value;
    
    // Remove non-numeric characters
    var numericValue = inputValue.replace(/[^0-9]/g, '');
    
    // Limit the number of digits to 
    numericValue = numericValue.slice(0, 11);
    
    // Update the input value
    this.value = numericValue;
    
    // Get error message element 
    var errorMessageElement = document.getElementById('yearErrorMessage');
    
    // Check if the number of digits is not equal to 11
    if (numericValue.length !== 4){
        errorMessageElement.textContent = "Year digits should be exactly 4.";
    } else {
       errorMessageElement.textContent = ""; 
    }
};
</script>
<script>
document.getElementById('e_year').oninput = function(){
    // Get the input value 
    var inputValue = this.value;
    
    // Remove non-numeric characters
    var numericValue = inputValue.replace(/[^0-9]/g, '');
    
    // Limit the number of digits to 
    numericValue = numericValue.slice(0, 11);
    
    // Update the input value
    this.value = numericValue;
    
    // Get error message element 
    var errorMessageElement = document.getElementById('expYearErrorMessage');
    
    // Check if the number of digits is not equal to 11
    if (numericValue.length !== 4){
        errorMessageElement.textContent = "Year digits should be exactly 4.";
    } else {
       errorMessageElement.textContent = ""; 
    }
};
</script>
<script>
document.getElementById('n_phone').oninput = function(){
    // Get the input value 
    var inputValue = this.value;
    
    // Remove non-numeric characters
    var numericValue = inputValue.replace(/[^0-9]/g, '');
    
    // Limit the number of digits to 
    numericValue = numericValue.slice(0, 11);
    
    // Update the input value
    this.value = numericValue;
    
    // Get error message element 
    var errorMessageElement = document.getElementById('nokPhoneErrorMessage');
    
    // Check if the number of digits is not equal to 11
    if (numericValue.length !== 11){
        errorMessageElement.textContent = "Phone digits should be exactly 11.";
    } else {
       errorMessageElement.textContent = ""; 
    }
};
</script>
