<?php
include_once("includes/links.php");
        // Generate a unique receipt number
        $minRange = 100000;
        $maxRange = 999999;
        $receiptNumber = generateUniqueReceiptNumber($minRange, $maxRange, $previousReceiptNumbers);
?>
<style>
  .dropdown:hover .dropdown-menu {
    display: block;
  }
  /* Custom CSS to remove the box around the dropdown menu */
  .dropdown-menu {
    border: none;
    box-shadow: none;
    background-color:#f8f9fa; 
  }
</style>
</head>
<body>
  <!--header section start -->
<div class="header_section header_bg">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="logo">
      <a href="dashboard.php">
        <img src="images/shurah_logo3.png">
      </a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProduct" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Product
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownProduct">
            <a class="dropdown-item" href="dashboard.php?page=pages/view_products">Product</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/add_products_category_select">Add New Product</a>
			<!--<a class="dropdown-item" href="dashboard.php?page=pages/branch_to_branch_transfer&transfer_id=<?php echo $receiptNumber ; ?>">Product Transfer</a>
			<a class="dropdown-item" href="dashboard.php?page=pages/view_branch_transfer">View Product Transfer List</a>-->
			<a class="dropdown-item" href="dashboard.php?page=pages/bulk_update_product_pricelist&update_id=<?php echo $receiptNumber ; ?>&prod_id=">Bulk Update Price List</a>
			<a class="dropdown-item" href="dashboard.php?page=pages/bulk_update_product&update_id=<?php echo $receiptNumber ; ?>&prod_id=">Update Product Quantity</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/view_update_product_list">Updated Quantity List</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/excel_upload">Update From Excel File</a>
          </div>
        </li>        
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProduct" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Sales
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownProduct">
            <!--<a class="dropdown-item" href="pages/retail_sales.php?invoice=<?php echo $time_string ; ?>&prod_id=&client_id=">Retail Sales</a>-->
            <a class="dropdown-item" href="dashboard.php?page=pages/process_payment">Retail Sales</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/view_reciept">Re-Print Receipt</a>
			<!--<a class="dropdown-item" href="dashboard.php?page=pages/add_credit_sales_invoice">Credit Sales Invoice</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/view_not_supplied">Not Supplied</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/modify_supplied_reciept">Modify Supplied Receipt</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/add_correct_invoice">Modify Sales Invoice</a>-->
          </div>
        </li>          
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProduct" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Clients
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownProduct">
            <a class="dropdown-item" href="dashboard.php?page=pages/view_clients">View Clients</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/add_clients">Add Client</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/add_client_payment">Payment History</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/add_make_payment">Make Payment</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/add_make_withdrawal">Make Withdrawal</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/view_clients_ledger">View Credit Ledger</a>
          </div>
        </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProduct" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Users
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownProduct">
            <a class="dropdown-item" href="dashboard.php?page=pages/view_users">Users</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/add_users">Add User</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/reset_password">Reset Password</a>
          </div>
        </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProduct" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Setup
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownProduct">
			<!--<a class="dropdown-item" href="dashboard.php?page=pages/view_branch">Branch</a>  
			<a class="dropdown-item" href="dashboard.php?page=pages/add_branch">Add Branch</a>-->  
            <a class="dropdown-item" href="dashboard.php?page=pages/view_category">Category</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/add_category">Add Category</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/add_bank">Add Bank</a>                                     
            <a class="dropdown-item" href="dashboard.php?page=pages/add_pos">Add POS</a> 
            <a class="dropdown-item" href="dashboard.php?page=pages/view_company_details">Company Setup</a>
            <a class="dropdown-item" href="dashboard.php?page=backups/database_backup">Backup Files</a>
          </div>
        </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProduct" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Reports
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownProduct">
            <a class="dropdown-item" href="dashboard.php?page=pages/view_sales_report">Sales reports</a>
            <!--<a class="dropdown-item" href="dashboard.php?page=pages/authorization_pin_page">Sales reports with profit</a>
			<a class="dropdown-item" href="dashboard.php?page=pages/view_sales_analysis">Weekly Sales Analysis</a>-->
            <a class="dropdown-item" href="dashboard.php?page=pages/view_daily_trial_balance">Trial Balance</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/aggregated_cashier_balances">Cashier Balances</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/view_price_list">Price list</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/view_stock_list">Stock list</a>
			<a class="dropdown-item" href="dashboard.php?page=pages/excel_sales_report_data">Sales reports excel download</a> 
            <a class="dropdown-item" href="dashboard.php?page=pages/excel_stock_report_data">Stock report excel download</a>
			<a class="dropdown-item" href="dashboard.php?page=pages/excel_expense_report_data">Expense Report excel download</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/view_re_order_level_list">Re-order level</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/excel_re_order_report_data">Re-order level report</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/view_expired_products">3Months to Expired Products</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/view_expired_products1">Expired Products</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/pdf_all_reports">All PDF Reports</a>
          </div>
        </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProduct" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Expenses
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownProduct">
            <a class="dropdown-item" href="dashboard.php?page=pages/view_expense_sub_head">Expense Sub-Head</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/add_expense_sub_head">Add Expense Sub-Head</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/view_expense">Expense</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/add_expense">Add Expense</a>
            <a class="dropdown-item" href="dashboard.php?page=pages/view_reversals">Reversals</a>
          </div>
        </li>
      </ul>
    </div>
        <div class="float:right" style="margin-right: 20px;">
            <a class="btn btn-danger btn-block btn-large" onclick="logout();"><strong>LOGOUT</strong></a> 
        </div>
  </nav>
</div>
<script>
function logout(button){
    var txt;
    if(confirm("Do you really want to logout?")){
        txt = "Logout";
        window.location.href = 'logout.php';
    }else{
        txt = "You pressed cancel";
    }
    document.getElementById("#button").innerHTML = txt;
}
</script>