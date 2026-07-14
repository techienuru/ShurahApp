
    <!--header section end -->
    <!--team section start -->
    <?php
        $rnd = date('YmdHms');
        $date = date('Y-m-d');

    ?>
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
    <div class="team_section layout_padding" style="margin-top: -100px">
      <div class="">
        <h1 class="what_taital">Products</h1>
        <p class="what_text_1"> </p>
          <div class="col-12" style="width: 100%;">
            <table id="contact-detail" class="display nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th  style="font-size: 12px;">SN</th>
                    <th  style="font-size: 12px;">Product ID</th>
                    <th  style="font-size: 12px;">Category</th>
                    <th  style="font-size: 12px;">Product Code</th>
                    <th  style="font-size: 12px;">Product Name</th>
                    <th  style="font-size: 12px;">Qty Left</th>
                    <th  style="font-size: 12px;">View</th>
                    <th  style="font-size: 12px;">Edit</th>
                    <th  style="font-size: 12px;">Delete</th>
                    </tr>
                </thead>
            </table>
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

</body>
<script>
$(document).ready(function() {
    $('#contact-detail').dataTable({
		"scrollX": true,
		"pagingType": "numbers",
        "processing": true,
        "serverSide": true,
        "ajax": "pages/view_products_server.php"
    } );
} );
</script>
</html>
<style>
    .form-control{
        border: 1px dotted;
    }
</style>
<style>
    #contact-detail td {
        font-size: 12px;
    }
</style>