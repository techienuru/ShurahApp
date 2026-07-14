

CREATE TABLE `bank` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `bank_id` int NOT NULL,
  `bank_name` varchar(55) NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO bank VALUES("1","1941","FIRSTBANK");
INSERT INTO bank VALUES("2","1300","ACCESS");
INSERT INTO bank VALUES("3","4527","FIDELITY");
INSERT INTO bank VALUES("4","5062","GTB");
INSERT INTO bank VALUES("5","3387","JAIZ-BANK");
INSERT INTO bank VALUES("6","3102","KEYSTONE");
INSERT INTO bank VALUES("7","1155","OPAY");
INSERT INTO bank VALUES("8","3085","STAMBIC-IBTC");
INSERT INTO bank VALUES("9","7727","STERLING");
INSERT INTO bank VALUES("10","9172","TAJ-BANK");
INSERT INTO bank VALUES("11","6545","UBA");
INSERT INTO bank VALUES("12","2472","ZENITH");
INSERT INTO bank VALUES("13","4768","ALTERNATIVE BANK");



CREATE TABLE `branch` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `activation_id` enum('inactive','active') NOT NULL DEFAULT 'inactive',
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `branch_to_branch_transfer` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `transfer_id` varchar(55) NOT NULL,
  `prod_code` varchar(255) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `qty` varchar(11) NOT NULL,
  `src_branch_id` int NOT NULL,
  `dstn_branch_id` int NOT NULL,
  `request_date` varchar(55) NOT NULL,
  `status` enum('pending','processed') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `category` (
  `category_id` varchar(55) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO category VALUES("5670","WATER","1");
INSERT INTO category VALUES("6881","DRINKS","1");
INSERT INTO category VALUES("9400","MILK","1");



CREATE TABLE `client_ledger` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `client_id` varchar(55) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `debit` bigint NOT NULL,
  `credit` bigint NOT NULL,
  `date` date NOT NULL,
  `user_id` varchar(55) NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO client_ledger VALUES("1","100001","152462","Cost of Goods purchased","15840","0","2024-08-26","20010701");
INSERT INTO client_ledger VALUES("2","100001","899440","Cost of Goods purchased","14880","0","2024-08-26","20010701");
INSERT INTO client_ledger VALUES("3","100001","774103","Cost of Goods purchased","15840","0","2024-08-26","20010701");
INSERT INTO client_ledger VALUES("4","100001","890946","PAYMENT FOR GOODS IFO 152462 Invoice","0","15000","2024-08-26","20010701");
INSERT INTO client_ledger VALUES("5","100001","545151","BALANCE PAYMENT IFO 152462 Invoice","0","840","2024-08-26","20010701");
INSERT INTO client_ledger VALUES("6","100001","704623","PAYMENT FOR GOODS IFO 899440 Invoice","0","14880","2024-08-26","20010701");
INSERT INTO client_ledger VALUES("7","100001","503746","PAYMENT FOR GOODS IFO 774103 Invoice","0","15840","2024-08-26","20010701");
INSERT INTO client_ledger VALUES("8","100001","558608","TRANSFER IFO  Invoice","0","10000","2024-08-26","20010701");
INSERT INTO client_ledger VALUES("9","100001","613167","CASH TRANSFERED","10000","0","2024-08-26","20010701");



CREATE TABLE `clients` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `name` varchar(55) NOT NULL,
  `address` varchar(55) NOT NULL,
  `gender` varchar(55) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `phone2` varchar(20) NOT NULL,
  `date` varchar(55) NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO clients VALUES("1","100001","MUSA","KADUNA","MALE","08063026509","08063026509","2024-08-26");



CREATE TABLE `company_details` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `motto` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `address3` varchar(255) NOT NULL,
  `address4` varchar(255) NOT NULL,
  `phone_no1` varchar(55) NOT NULL,
  `phone_no2` varchar(55) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `withdrawal_charge` varchar(11) DEFAULT NULL,
  `surcharge` varchar(55) NOT NULL,
  `equity_contribution_rate` varchar(11) DEFAULT NULL,
  `loan_savings` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO company_details VALUES("1","SHURAH SUPER STORES","FOR ALL YOUR NEEDS.","Muhammad Alagbe Plaza, beside Total Service Station Keffi Nasarawa State.","Muhammad Alagbe Plaza, beside Total Service Station Keffi Nasarawa State.","Nasarawa State.","Nasarawa State.","+234 ","+234 ","abc@gmail.com","nil","40","25","10","0.5");



CREATE TABLE `expence_sub_head` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `expence_code` varchar(255) NOT NULL,
  `expence_name` varchar(255) NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

INSERT INTO expence_sub_head VALUES("2","20230418104654","DIESEL/FUEL/GAS");
INSERT INTO expence_sub_head VALUES("3","20230418104700","CONSUMABLES");
INSERT INTO expence_sub_head VALUES("4","20230418104710","STATIONERY");
INSERT INTO expence_sub_head VALUES("5","20230418104715","COMPUTER ACCESSORIES");
INSERT INTO expence_sub_head VALUES("6","20230418104722","ELECTRICITY");
INSERT INTO expence_sub_head VALUES("7","20230418104733","OFFICE EQUIPMENT");
INSERT INTO expence_sub_head VALUES("8","20230418104753","ELECTRICAL");
INSERT INTO expence_sub_head VALUES("12","20230712211557","ENTERTAINMENT");
INSERT INTO expence_sub_head VALUES("13","20230712212034","STAFF SALARY");
INSERT INTO expence_sub_head VALUES("18","20240825125549","CEO EXPENSE");



CREATE TABLE `expence_table` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `expence_id` varchar(255) NOT NULL,
  `expence_code` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `date` varchar(40) NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `expense_table_reversal` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `branch_id` int NOT NULL,
  `expense_id` varchar(55) NOT NULL,
  `expense_name` varchar(55) NOT NULL,
  `rev_reason` varchar(255) NOT NULL,
  `rev_amount` varchar(55) NOT NULL,
  `date` varchar(55) NOT NULL,
  `user_id` varchar(55) NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `invoice` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `invoice` varchar(55) NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `pos` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `pos_id` int NOT NULL,
  `pos_name` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO pos VALUES("1","1571","TAJ-BANKPOS");
INSERT INTO pos VALUES("2","9290","MONIE POINT");
INSERT INTO pos VALUES("3","2017","OPAY");
INSERT INTO pos VALUES("4","1367","PALMPAY");



CREATE TABLE `product` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `prod_id` varchar(255) NOT NULL,
  `prod_code` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `ctn_num` varchar(255) NOT NULL,
  `pcs` int NOT NULL,
  `qty_left` int NOT NULL,
  `divider` int NOT NULL,
  `cost_price` int NOT NULL,
  `selling_price` int NOT NULL,
  `expiration` date NOT NULL,
  `date` varchar(55) NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO product VALUES("1","591835","591835","6881","BOTTLE COKE","","484","340","24","300","350","2025-03-26","2024-08-26");
INSERT INTO product VALUES("2","242015","242015","5670","RANGOLISE WATER 75CL","","125","113","12","200","250","2024-12-26","2024-08-26");



CREATE TABLE `product_movement_log` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `update_product_id` varchar(11) NOT NULL,
  `prod_code` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  `qty_in` varchar(55) NOT NULL,
  `qty_out` varchar(55) NOT NULL,
  `category` varchar(55) NOT NULL,
  `expiration` varchar(55) NOT NULL,
  `description` enum('stock in','stock out','product sales','product update') NOT NULL DEFAULT 'product update',
  `status` enum('pending','processed') NOT NULL DEFAULT 'pending',
  `user_id` varchar(55) NOT NULL,
  `date` varchar(55) NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO product_movement_log VALUES("1","591835","591835","0","240","0","6881","2025-03-30","stock in","processed","20010701","2024-08-26");
INSERT INTO product_movement_log VALUES("2","242015","242015","0","120","0","5670","2024-12-26","stock in","processed","20010701","2024-08-26");
INSERT INTO product_movement_log VALUES("3","347894","591835","BOTTLE COKE","244","0","6881","2025-03-26","product update","processed","20010701","2024-08-26");
INSERT INTO product_movement_log VALUES("4","347894","242015","RANGOLISE WATER 75CL","5","0","5670","2024-12-26","product update","processed","20010701","2024-08-26");
INSERT INTO product_movement_log VALUES("5","152462","591835","BOTTLE COKE","0","48","6881","default","product sales","processed","20010701","2024-08-26");
INSERT INTO product_movement_log VALUES("6","899440","591835","BOTTLE COKE","0","48","6881","default","product sales","processed","20010701","2024-08-26");
INSERT INTO product_movement_log VALUES("7","774103","591835","BOTTLE COKE","0","48","6881","default","product sales","processed","20010701","2024-08-26");
INSERT INTO product_movement_log VALUES("8","481138","242015","RANGOLISE WATER 75CL","0","12","5670","default","product sales","processed","20010701","2024-08-26");



CREATE TABLE `sales` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `prod_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `invoice` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cashier` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cash` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pos` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `transfer` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bank` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pos_medium` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_id` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `amount` varchar(100) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `discount` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `total_payment` varchar(55) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `client_name` varchar(55) NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_id` varchar(55) NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO sales VALUES("1","591835","2024-08-26","152462","buchi","0","0","0","","","100001","15840","15840","0","0","MUSA","SUPPLIED","20010701");
INSERT INTO sales VALUES("2","","2024-08-26","899440","buchi","0","0","0","","","100001","14880","14880","0","0","MUSA","SUPPLIED","20010701");
INSERT INTO sales VALUES("3","591835","2024-08-26","774103","buchi","0","0","0","","","100001","15840","15840","0","0","MUSA","SUPPLIED","20010701");
INSERT INTO sales VALUES("4","242015","2024-08-26","481138","buchi","2800","0","0","","","0","3000","0","200","2800","SULE","SUPPLIED","20010701");
INSERT INTO sales VALUES("5","OSTN","2024-08-26","890946","buchi","5000","10000","0","","","100001","15000","0","0","15000","MUSA","","20010701");
INSERT INTO sales VALUES("6","OSTN","2024-08-26","545151","buchi","840","0","0","","","100001","840","0","0","840","MUSA","","20010701");
INSERT INTO sales VALUES("7","OSTN","2024-08-26","704623","buchi","14880","0","0","","","100001","14880","0","0","14880","MUSA","","20010701");
INSERT INTO sales VALUES("8","OSTN","2024-08-26","503746","buchi","0","15840","0","","","100001","15840","0","0","15840","MUSA","","20010701");
INSERT INTO sales VALUES("9","OSTN","2024-08-26","558608","buchi","0","0","10000","TAJ-BANK","","100001","10000","0","0","10000","MUSA","","20010701");



CREATE TABLE `sales_order` (
  `transaction_id` int NOT NULL AUTO_INCREMENT,
  `invoice` varchar(100) NOT NULL,
  `prod_code` varchar(255) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL,
  `date` varchar(55) NOT NULL,
  `qtyleft` varchar(100) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status` enum('pending','processed') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO sales_order VALUES("3","152462","591835","48","15840","BOTTLE COKE","350","960","6881","2024-08-26","436","0","processed");
INSERT INTO sales_order VALUES("5","899440","591835","48","14880","BOTTLE COKE","330","960","6881","2024-08-26","388","0","processed");
INSERT INTO sales_order VALUES("7","774103","591835","48","15840","BOTTLE COKE","330","960","6881","2024-08-26","340","0","processed");
INSERT INTO sales_order VALUES("8","481138","242015","12","3000","RANGOLISE WATER 75CL","250","0","5670","2024-08-26","113","0","processed");



CREATE TABLE `status` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `status` int NOT NULL,
  `status_name` varchar(255) NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO status VALUES("1","1","Active");
INSERT INTO status VALUES("2","2","Inactive");



CREATE TABLE `update_product` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `update_product_id` varchar(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` varchar(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO update_product VALUES("1","347894","Bulk Update","2024-08-26","20010701");



CREATE TABLE `update_product_order` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `update_product_id` varchar(11) DEFAULT NULL,
  `prod_code` varchar(55) DEFAULT NULL,
  `name` varchar(55) DEFAULT NULL,
  `qty_in` varchar(55) DEFAULT NULL,
  `qty_out` varchar(55) DEFAULT NULL,
  `category` varchar(55) DEFAULT NULL,
  `description` enum('stock in','stock out','product sales','product update') DEFAULT 'product update',
  `status` enum('pending','processed') DEFAULT 'pending',
  `user_id` varchar(55) DEFAULT NULL,
  `expiration` varchar(55) NOT NULL,
  `date` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO update_product_order VALUES("1","347894","591835","BOTTLE COKE","244","0","6881","product update","processed","20010701","2025-03-26","2024-08-26");
INSERT INTO update_product_order VALUES("2","347894","242015","RANGOLISE WATER 75CL","5","0","5670","product update","processed","20010701","2024-12-26","2024-08-26");



CREATE TABLE `update_product_price_list` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `update_product_id` varchar(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` varchar(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO update_product_price_list VALUES("1","809859","Bulk Update Price list","2024-08-26","20010701");



CREATE TABLE `update_product_price_list_order` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `update_product_id` varchar(11) NOT NULL,
  `prod_code` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  `cost_price` varchar(11) NOT NULL,
  `selling_price` varchar(55) NOT NULL,
  `category` varchar(55) NOT NULL,
  `date` varchar(55) NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO update_product_price_list_order VALUES("2","809859","242015","RANGOLISE WATER 75CL","200","250","WATER","2024-08-26");
INSERT INTO update_product_price_list_order VALUES("3","809859","591835","BOTTLE COKE","300","350","DRINKS","2024-08-26");



CREATE TABLE `users` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(55) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `status` varchar(25) NOT NULL,
  `isActive` varchar(25) NOT NULL,
  `role` varchar(255) NOT NULL,
  `date` varchar(55) NOT NULL,
  `authorization` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO users VALUES("1","20010701","BUCHI DANIEL","buchi","c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec","07033433535","Existing User","1","admin","2023-07-12","1268");
INSERT INTO users VALUES("10","20120252","DORCAS","dorcas","22086982656bd9abc82ca8d597fde88c35590e920fa997c39ec0199426af188028d362b438cd08d2630bc11d5535b4e0888a6c8ec3af6a3acb1a1991b86173c1","08069163310","Existing User","1","admin","2024-02-15","1111");
INSERT INTO users VALUES("12","20140209","DAN","dan","3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79","08069163310","Existing User","1","cashier","2024-02-16","1111");
INSERT INTO users VALUES("13","20120818","MUSA","musa","3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79","08063026509","New User","1","admin","2024-08-26","1111");



CREATE TABLE `way_bill` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `way_bill_id` varchar(11) NOT NULL,
  `branch_id` int NOT NULL,
  `location` varchar(255) NOT NULL,
  `truck_number` varchar(55) DEFAULT NULL,
  `date` varchar(55) NOT NULL,
  `user_id` varchar(55) NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


