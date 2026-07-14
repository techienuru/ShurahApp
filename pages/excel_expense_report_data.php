
        <!--header section end -->
        <!--team section start -->
        <?php
            $rnd = date('YmdHms');
            $date = date('Y-m-d');

        ?>
        <div class="team_section layout_padding">

          <div class="">
            <h1 class="what_taital">Download expenses report in excel format</h1>
            <p class="what_text_1"> </p>

            <div class="container">
                <h1 class="text-center"><b> </b></h1>
                <div class="box">
                    <h3 class="text-center"><b>Expenses Details</b></h3>
                    <hr>
                    <form action="pages/excel_expense_report_data_with_date_range.php" method="post">
                      <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>From :</label></b>
                                <input class="form-control" type="date" style="font-size: 12px;" name="date1" format="yyyy-mm-dd" value="" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <b><label>To :</label></b>
                                <input class="form-control" type="date" style="font-size: 12px;" name="date2" format="yyyy-mm-dd" value="" required>
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