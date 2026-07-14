
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = createthree();
        $date = date('Y-m-d');

    ?>
    <div class="team_section layout_padding">
        <div class="container">
            <?php if (!empty($_GET['success'])): ?>
                <div class="row">
                    <div class="col-6 alert alert-primary text-center" style="margin-top: 20px; left: 50%; transform: translateX(-50%);">
                        <h4><?php echo $_GET['success']; ?></h4>
                    </div>
                </div>
            <?php elseif (!empty($_GET['error'])): ?>
                <div class="row">
                    <div class="col-6 alert alert-danger text-center" style="margin-top: 20px; left: 50%; transform: translateX(-50%);">
                        <?php echo $_GET['error']; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <!-- Rest of the code -->
    </div>
    <div class="team_section layout_padding"  style="margin-top: -100px">
      <div class="">
        <h1 class="what_taital">Update Product using Excel file</h1>
        <p class="what_text_1"> </p>

        <div class="container">
            <h1 class="text-center"><b> </b></h1>
            <div class="box">
                <h3 class="text-center"><b>File Details</b></h3>
                <hr>
                <form action="dashboard.php?page=pages/excel_upload_process" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <b><label>Upload File :</label></b>
                                <input class="form-control" type="file" name="upload_file" value="<?php echo $rnd ; ?> " readonly required>
                            </div>
                        </div> 
                        <div class="form-text">
                            <b>Allowed File Type: xls, xlsx. Must have header line.</b>
                        </div>           
                    </div>
                    <!-- <div class="progress" style="margin-top: 20px;">
                        <progress id="progressBar" value="0" max="100" style="width: 100%;"></progress>
                        <p id="status"></p>
                    </div> -->
                     <hr>
                    <div class="text-right">
                        <div class="form-group">
                            <div class="text-right">
                                <button type="reset" id="reset" name="reset" class="btn btn-warning" onclick="reloadPage();">Reset</button>
                                <button type="submit" id="submit" name="submit" class="btn btn-primary">Upload</button>
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
    <script src="../js/dist/js/select2.min.js"></script>

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
<script>
document.getElementById("submit").addEventListener("click", function () {
    const fileInput = document.getElementById("upload_file");
    if (fileInput.files.length === 0) {
        alert("Please select a file to upload.");
        return;
    }

    const formData = new FormData();
    formData.append("upload_file", fileInput.files[0]);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "dashboard.php?page=pages/excel_upload_process", true);

    // Update progress bar
    xhr.upload.addEventListener("progress", function (event) {
        if (event.lengthComputable) {
            const percentComplete = Math.round((event.loaded / event.total) * 100);
            document.getElementById("progressBar").value = percentComplete;
            document.getElementById("status").textContent = percentComplete + "% uploaded...";
        }
    });

    // When upload is complete
    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById("status").textContent = "Upload complete!";
            document.getElementById("progressBar").value = 100;
        } else {
            document.getElementById("status").textContent = "Error: Upload failed.";
        }
    };

    // Handle errors
    xhr.onerror = function () {
        document.getElementById("status").textContent = "Error: Upload failed.";
    };

    // Send the form data
    xhr.send(formData);
});
</script>
<style>
.progress {
    border: 1px solid #ddd;
    border-radius: 4px;
    height: 20px;
    overflow: hidden;
    background-color: #f3f3f3;
}

progress {
    height: 100%;
    width: 100%;
    appearance: none;
}

progress::-webkit-progress-bar {
    background-color: #f3f3f3;
}

progress::-webkit-progress-value {
    background-color: #007bff;
}

progress::-moz-progress-bar {
    background-color: #007bff;
}
</style>

