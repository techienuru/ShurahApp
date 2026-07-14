
        <!--header section end -->
        <!--team section start -->
        <?php
            $rnd = date('YmdHms');
            $date = date('Y-m-d');
        // to get the first date from product as the startdate
        $start_date_sql = "SELECT MIN(date) AS start_date FROM product ";
        $start_date_query = mysqli_query($db_connect, $start_date_sql);
        $start_date_rs = mysqli_fetch_assoc($start_date_query);
        if(empty($start_date_rs)){
            $start_date = '2024-01-01';
        }else{
            $start_date = $start_date_rs['start_date'];
        }

        ?>
        <div class="team_section layout_padding">

          <div class="">
            <h1 class="what_taital">Stock List Report PDF format</h1>
            <p class="what_text_1"> </p>

            <div class="container">
                <h1 class="text-center"><b> </b></h1>
                <div class="box">
                    <h3 class="text-center"><b>Stock List Report Details</b></h3>
                    <hr>
                    <form action="generate_stock_list_report_date_pdf.php" method="post">
                      <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>From :</label></b>
                                <input class="form-control" type="date" style="font-size: 12px;" name="start_date" format="yyyy-mm-dd" value="<?php echo $start_date; ?>" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>To :</label></b>
                                <input class="form-control" type="date" style="font-size: 12px;" name="end_date" format="yyyy-mm-dd" value="" required>
                            </div>
                        </div> 
                        <div class="col-4">
                            <div class="form-group">
                                <a href=""><button class="btn btn-primary" name="generate" id="generate" style="margin-left: 3px; margin-top:24px;"><i class="fa fa-download"></i> Download Report</button></a>
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
    <script type="text/javascript">
        function multi(){
            var qty = document.getElementById('qty').value;
            var cart_qty = document.getElementById('cart_qty').value;
            var result = parseInt(qty) * parseInt(cart_qty);
            if(!isNaN(result)){
                document.getElementById('pcs').value = result;
            }
        }

    </script>