
    <div class="box" style="margin-top:-10px;">
        <div class="row">
            <div class="col-12">
                <?php
                if(empty($_GET['error']) && empty($_GET['success'])){
                    
                }else{
                if(empty($error)){
                    if(empty($_GET['error'])){
                    echo "<div class='alert alert-success' role='alert'>";
                    echo $_GET['success'];
                    echo "<br>";        
                    echo "</div>";
                 }else{
  
                 };
                }else if(empty($_GET['success'])){
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo $_GET['error'];
                    echo "<br>";        
                    echo "</div>";  
                }
                }
                ?>
                <hr>
                <br>
            <a class="btn btn-danger" href="login.php">Sign In</a>  
            </div>
        </div>
    </div>