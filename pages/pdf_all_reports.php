
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');

    ?>
        <div class="team_section layout_padding">
            <div class="container">
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
    <div class="team_section layout_padding" style="margin-top: -100px">
        <h1 class="what_taital">All PDF Reports</h1>
      <div class="container">
        <p class="what_text_1"> </p>
          <div class="box" style="width: 100%;">
           <div class="row">
              <div class="col-2">
                <a  href="generate_user_pdf.php" class="btn btn-primary">Generate Users PDF</a>
              </div>              
              <div class="col-2">
                <a  href="generate_sales_report_pdf.php" class="btn btn-primary">Generate Sales Report PDF</a>
              </div>              
              <div class="col-2">
                <a  href="dashboard.php?page=pages/pdf_sales_report_with_date" class="btn btn-primary">General Sales Report (Date)</a>
              </div>              
              <div class="col-2">
                <a  href="dashboard.php?page=pages/pdf_trial_balance_report_with_date" class="btn btn-primary">Trial Balance (Date)</a>
              </div>
              <div class="col-2">
                <a  href="dashboard.php?page=pages/pdf_stock_list_report_with_date" class="btn btn-primary">Stock Report (Date)</a>
              </div>  
              <br>
              <br>
              <br>
              <div class="col-2">
                <a  href="generate_three_months_expiration_report_date_pdf.php" class="btn btn-primary">3 Months to Expiration</a>
              </div>               
              <div class="col-2">
                <a  href="generate_expired_product_report_date_pdf.php" class="btn btn-primary">Expired Product Report</a>
              </div>
              <div class="col-2">
                <a  href="dashboard.php?page=pages/pdf_expenses_report_with_date" class="btn btn-primary">Expenses Report (Date)</a>
              </div>
              <div class="col-2">
                <a  href="dashboard.php?page=pages/pdf_top_selling_report_with_date" class="btn btn-primary">Top Selling Report (Date)</a>
              </div> 
              <div class="col-2">
                <a  href="dashboard.php?page=pages/pdf_out_of_stock_report_with_date" class="btn btn-primary">Out Of Stock Product</a>
              </div>
              <div class="col-2">
                <a  href="dashboard.php?page=pages/pdf_sales_with_profit_report_with_date" class="btn btn-primary">Sales and Profits</a>
              </div>               
               <div class="col-2">
                <a  href="dashboard.php?page=pages/pdf_discountedsales_report_with_date" class="btn btn-primary">Discounted Report</a>
              </div> 
              
<!--              <button type="submit" id="submit" name="submit" class="btn btn-primary">Save</button>-->
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
<script>
$(document).ready(function() {
    $('#contact-detail').dataTable({
		"scrollX": true,
		"pagingType": "numbers",
        "processing": true,
        "serverSide": true,
        "ajax": "pages/view_users_server.php"
    } );
} );
</script>
</html>
<style>
    .form-control{
        border: 1px dotted;
    }
</style>