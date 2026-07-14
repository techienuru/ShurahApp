<div class="container" >
         <div class="box" style="width: 100%;">
             <div class="row" style="margin-left: 1px; margin-right: -2%; margin-top: 2%;">      
                  <div class="alert alert-success" style="width: 20%; margin-left: -8px;"><h5 class="text-center"><strong> Clients</strong></h5><h5 class="text-center"><center><div class="icon"><i class="fa fa-user-friends fa-2x"></i></div></center><?php echo $total_client; ?></h5></div>           
                  <div class="alert alert-secondary" style="width: 20%"><h5 class="text-center"><strong>Products</strong></h5><h5 class="text-center" ><center><div class="icon"><i class="fa fa-box fa-2x"></i></div></center><?php echo number_format($total_products) ; ?></h5></div>
                 <div class="alert alert-success" style="width: 19%"><h5 class="text-center"><strong>Re-Stock Level</strong></h5><h5 class="text-center" ><center><div class="icon"><i class="fa fa-sync fa-2x"></i></div></center><?php echo number_format($re_stock) ; ?></h5></div>
                 <div class="alert alert-secondary" style="width: 19%"><h5 class="text-center"><strong>Daily Expense</strong></h5><h5 class="text-center" ><center><div class="icon"><i class="fa fa-money-bill-wave fa-2x"></i></div></center><?php echo "₦ ". number_format($total_daily_expense) ; ?></h5></div>
                 <div class="alert alert-success" style="width: 19%"><h5 class="text-center"><strong>Total Cash</strong></h5><h5 class="text-center" ><center><div class="icon"><i class="fa fa-money-bill-wave fa-2x"></i></div></center><?php echo "₦ ". number_format($total_cash) ; ?></h5></div>                                     
         	 </div>
		</div>
		<!--<div class="box" style="width: 100%; margin-top: -5px;">
			 <div class="row" style="margin-left: 1px; margin-right: -2%; margin-top: 2%;">      
                  <div class="alert alert-success" style="width: 20%; margin-left: -8px;"><h5 class="text-center"><strong>Balance Brought Forward</strong></h5><h5 class="text-center"><center><div class="icon"><i class="fa fa-money-bill-wave fa-2x"></i></div></center><?php  ?></h5></div>           
                  <div class="alert alert-secondary" style="width: 20%"><h5 class="text-center"><strong>Total Cash</strong></h5><h5 class="text-center" ><center><div class="icon"><i class="fa fa-money-bill-wave fa-2x"></i></div></center><?php echo "₦ ". number_format($total_cash) ; ?></h5></div>
                 <div class="alert alert-success" style="width: 19%"><h5 class="text-center"><strong>Total POS Transaction</strong></h5><h5 class="text-center" ><center><div class="icon"><i class="fa fa-money-bill-wave fa-2x"></i></div></center><?php echo "₦ ". number_format($total_pos) ; ?></h5></div>
                 <div class="alert alert-secondary" style="width: 19%"><h5 class="text-center"><strong>Total Transfer</strong></h5><h5 class="text-center" ><center><div class="icon"><i class="fa fa-money-bill-wave fa-2x"></i></div></center><?php echo "₦ ". number_format($total_transfer) ; ?></h5></div>
                 <div class="alert alert-success" style="width: 19%"><h5 class="text-center"><strong>Total Transaction</strong></h5><h5 class="text-center" ><center><div class="icon"><i class="fa fa-money-bill-wave fa-2x"></i></div></center><?php echo "₦ ". number_format($total_transaction) ; ?></h5></div>                                     
         </div>     
    </div>-->  
</div>