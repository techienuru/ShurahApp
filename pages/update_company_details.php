<?php
$id = $_GET['id'];
?>

        <div class="container">
            <div class="box">
            <?php
                $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
				$lastList_sql = "SELECT a.company_name, a.motto, a.address1, a.address2, a.address3, a.address4, a.phone_no1, a.phone_no2, a.email, a.website FROM company_details a";
				$lastList_query = mysqli_query($db_connect, $lastList_sql);
				$lastList_rs = mysqli_fetch_assoc($lastList_query);
				$company_name = $lastList_rs['company_name'];
				$motto = $lastList_rs['motto'];
				$address1 = $lastList_rs['address1'];
				$address2 = $lastList_rs['address2'];
				$address3 = $lastList_rs['address3'];
				$address4 = $lastList_rs['address4'];
				$phone_no1 = $lastList_rs['phone_no1'];
				$phone_no2 = $lastList_rs['phone_no2'];
				$email = $lastList_rs['email'];
				$website = $lastList_rs['website'];
				
                if(isset($_POST['submit'])){
                $company_name = $_POST['company_name'];
                $motto = $_POST['motto'];
                $address1 = $_POST['address1'];;
                $address2 = $_POST['address2'];;
                $address3 = $_POST['address3'];;
                $address4 = $_POST['address4'];;
                $phone_no1 = $_POST['phone_no1'];;
                $phone_no2 = $_POST['phone_no2'];;
                $email = $_POST['email'];;
                $website = $_POST['website'];;

                if($lastList_rs['company_name'] != $_POST['company_name']|| $lastList_rs['motto'] != $_POST['motto']|| $lastList_rs['address1'] != $_POST['address1']|| $lastList_rs['address2'] != $_POST['address2']|| $lastList_rs['address3'] != $_POST['address3']|| $lastList_rs['address4'] != $_POST['address4']|| $lastList_rs['phone_no1'] != $_POST['phone_no1']|| $lastList_rs['phone_no2'] != $_POST['phone_no2']|| $lastList_rs['email'] != $_POST['email']|| $lastList_rs['website'] != $_POST['website']){
                $new_company_name = mysqli_real_escape_string($db_connect, strtoupper($_POST['company_name']));
                $new_motto = mysqli_real_escape_string($db_connect, strtoupper($_POST['motto']));
                $new_address1 = mysqli_real_escape_string($db_connect, $_POST['address1']);
                $new_address2 = mysqli_real_escape_string($db_connect, $_POST['address2']);
                $new_address3 = mysqli_real_escape_string($db_connect, $_POST['address3']);
                $new_address4 = mysqli_real_escape_string($db_connect, $_POST['address4']);
                $new_phone_no1 = mysqli_real_escape_string($db_connect, $_POST['phone_no1']);
                $new_phone_no2 = mysqli_real_escape_string($db_connect, $_POST['phone_no2']);
                $new_email = mysqli_real_escape_string($db_connect, $_POST['email']);
                $new_website = mysqli_real_escape_string($db_connect, $_POST['website']);

                $update_sql = "UPDATE company_details SET company_name='{$new_company_name}',motto='{$new_motto}',address1='{$new_address1}',address2='{$new_address2}',address3='{$new_address3}',address4='{$new_address4}',phone_no1='{$new_phone_no1}',phone_no2='{$new_phone_no2}',email='{$new_email}',website='{$new_website}'";
                $update_query = mysqli_query($db_connect,$update_sql);
                if($update_query){
                    echo "<div class='alert alert-success'>Product successully updated.</div>";
                    $sucess = "Company details successully updated.";
                    header("Location:dashboard.php?page=pages/view_company_details&success={$sucess}");
                }else{
                    die(mysqli_error($db_connect));
                    $error = "Unable to update Company details";
                    header("Location:dashboard.php?page=pages/view_company_details&error={$error}");              
                    }   
                }else{
                    echo "<div class='alert alert-danger'>Nothing to update</div>";
                    $error = "Nothing to update";
                    header("Location:dashboard.php?page=pages/view_company_details&error={$error}"); 
                }  
            } 
            ?>
                    <div class="text-right">
                        <a href="dashboard.php?page=pages/view_company_details" class="btn btn-info">Back</a>
                    </div>
            </div>
        </div>

<?php 
?>
