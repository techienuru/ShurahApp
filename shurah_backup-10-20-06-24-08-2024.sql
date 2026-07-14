

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

INSERT INTO category VALUES("7784","WATER","1");



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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

INSERT INTO expence_sub_head VALUES("2","20230418104654","DIESEL/FUEL/GAS");
INSERT INTO expence_sub_head VALUES("3","20230418104700","CONSUMABLES");
INSERT INTO expence_sub_head VALUES("4","20230418104710","STATIONERY");
INSERT INTO expence_sub_head VALUES("5","20230418104715","COMPUTER ACCESSORIES");
INSERT INTO expence_sub_head VALUES("6","20230418104722","ELECTRICITY");
INSERT INTO expence_sub_head VALUES("7","20230418104733","OFFICE EQUIPMENT");
INSERT INTO expence_sub_head VALUES("8","20230418104753","ELECTRICAL");
INSERT INTO expence_sub_head VALUES("12","20230712211557","ENTERTAINMENT");
INSERT INTO expence_sub_head VALUES("13","20230712212034","STAFF SALARY");
INSERT INTO expence_sub_head VALUES("17","20240211090945","CEO EXPENSE");



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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO product VALUES("1","748102","748102","7784","RANGOLISE WATER","1","27","27","12","150","200","2025-01-24","2024-08-24");



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
) ENGINE=InnoDB AUTO_INCREMENT=355 DEFAULT CHARSET=latin1;

INSERT INTO product_movement_log VALUES("1","328090","UFEL20","0","90","0","1834","2025-11-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("2","404446","6941389310035","0","30","0","1834","2026-02-28","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("3","874014","874014","0","100","0","1834","2026-01-31","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("4","223233","UCLO108","0","100","0","1834","2025-04-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("5","651718","UCLO107","0","160","0","1834","2024-11-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("6","524489","8906009232225","0","30","0","1834","2024-11-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("7","636066","8901296108284","0","600","0","1834","2026-02-28","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("8","585984","585984","0","10","0","1834","2027-09-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("9","153358","6971161600191","0","340","0","1834","2026-03-31","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("10","153409","153409","0","18","0","1834","2025-05-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("11","925219","8903882000125","0","100","0","1834","2025-01-31","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("12","477373","UANO06","0","80","0","1834","2025-12-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("13","765715","765715","0","17","0","1834","2026-05-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("14","468369","UANO06","ANOROL (HOVID)","0","10","1834","default","product sales","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("15","616482","6151006000229","0","204","0","1834","2028-08-31","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("16","938601","8904210707259","0","40","0","1834","2025-10-31","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("17","375863","6154000033002","0","120","0","1834","2028-11-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("18","718562","6161105661986","0","70","0","1834","2025-11-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("19","419631","6034000140682","0","468","0","1834","2026-05-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("20","834328","8906045884297","0","100","0","1834","2025-01-31","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("21","913141","6156000067681","0","450","0","1834","2025-08-31","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("22","742733","6971161600016","0","170","0","1834","2025-04-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("23","369390","6221045010159","0","24","0","6543","2025-06-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("24","443265","9556100104342","0","40","0","6543","2025-11-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("25","627625","8995858187558","0","164","0","6543","2028-08-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("26","919971","8995858999991","0","52","0","6543","2027-12-31","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("27","341355","6156000045658","0","300","0","6543","2025-08-31","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("28","657013","657013","0","4","0","5059","2025-05-31","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("29","276191","276191","0","2","0","5059","2024-02-29","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("30","630138","6161105660286","0","68","0","7271","0024-06-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("31","424562","6161105660286","ANDREWS LIVER SALT","0","1","7271","default","product sales","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("32","238817","6156000127552","0","3","0","5059","2025-01-31","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("33","295657","8906007517492","0","3","0","5059","2024-11-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("34","255114","6156000132587","0","2","0","5059","2027-06-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("35","714218","6156000132631","0","9","0","5059","","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("36","837872","6156000132570","0","5","0","5059","2025-12-31","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("37","580188","6156000132600","0","1","0","5059","2026-06-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("38","966959","6156000132600","ANTARLLERGE","1","0","5059","2026-06-30","product update","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("39","835756","6156000132662","0","2","0","5059","2025-08-31","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("40","243765","6156000132600","ANTARLLERGE","-1","0","5059","2026-06-30","product update","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("41","137962","8906007513920","0","2","0","5059","2025-07-31","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("42","162066","6156000223834","0","3","0","5059","2025-10-31","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("43","706206","706206","0","3","0","5059","2026-04-30","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("44","174655","8906045946452","0","5","0","9526","2024-12-31","stock in","processed","20010701","2024-02-13");
INSERT INTO product_movement_log VALUES("45","733410","8901117460218","0","12","0","9526","2025-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("46","341422","341422","0","3","0","9526","2026-10-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("47","183043","8901117460218","0","3","0","9526","2025-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("48","415616","18906036360509260731P3473P231605811","0","8","0","7333","2026-07-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("49","896611","896611","0","2","0","7333","2026-07-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("50","270313","270313","0","5","0","7333","","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("51","555307","555307","0","96","0","7333","2026-02-28","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("52","597685","597685","0","96","0","7333","2026-02-28","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("53","156959","156959","0","93","0","7333","2026-02-28","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("54","262370","262370","0","109","0","7333","2026-02-28","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("55","338705","6972544371233","0","20","0","7333","2024-08-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("56","225450","225450","0","21","0","7333","2026-01-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("57","876675","876675","0","1","0","7333","2024-08-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("58","782524","6223293105861","0","10","0","7333","2026-01-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("59","466607","634753387240","0","26","0","7333","2025-07-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("60","449812","449812","0","2","0","7333","2025-02-28","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("61","219421","219421","0","3","0","7333","2025-02-28","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("62","468891","6156000081366","0","3","0","9582","2027-01-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("63","332153","8906009230535","0","2","0","9582","2025-05-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("64","621196","6156000081328","0","3","0","9582","2026-12-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("65","885805","6156000081311","0","4","0","9582","2027-04-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("66","744318","6156000081311","0","5","0","9582","2027-04-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("67","743166","6156000127620","0","4","0","9582","2027-04-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("68","850486","850486","0","5","0","9582","2027-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("69","495061","6156000081465","0","5","0","9582","2026-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("70","627886","6921465734849","0","10","0","9582","2026-02-22","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("71","528547","0108902292002323","0","5","0","9582","2025-05-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("72","118237","6156000158235","0","2","0","9582","2024-11-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("73","956686","5285001820764","0","6","0","8949","","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("74","700537","6156000127613","0","2","0","9582","2025-01-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("75","700674","203325740624","0","6","0","1300","","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("76","893337","6034000231267","0","4","0","9582","2025-02-28","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("77","853300","6156000223919","0","2","0","9582","2027-06-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("78","365955","6156000127590","0","2","0","9582","2027-01-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("79","172533","6151006000366","0","30","0","2935","2027-12-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("80","589817","6156000081342","0","2","0","9582","2026-08-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("81","787128","6156000081335","0","3","0","9582","","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("82","888484","888484","0","8","0","9582","2026-02-28","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("83","515446","515446","0","2","0","9582","2025-04-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("84","657473","657473","0","2","0","9582","2025-10-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("85","246831","6151006000175","0","260","0","2935","2028-01-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("86","992924","UVIR18","0","2","0","9582","2025-03-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("87","130561","6971212071598","0","1","0","9582","2025-05-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("88","907752","6154000077365","0","250","0","2935","2026-05-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("89","547513","6154000136024","0","70","0","2935","2025-06-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("90","186336","186336","0","90","0","2935","2026-11-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("91","702912","6154000077396","0","330","0","2935","2026-06-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("92","330811","6154000077280","0","200","0","2935","2026-07-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("93","302886","6154000077303","0","170","0","2935","2026-06-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("94","209576","2899305830071509576","0","13","0","6543","2026-09-22","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("95","393735","8904185502804","0","120","0","2935","2026-08-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("96","789569","UDOX06","0","120","0","2935","2024-05-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("97","580292","580292","0","50","0","8949","2025-05-18","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("98","282660","0118906045620533","0","8","0","8949","","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("99","138772","138772","0","90","0","8949","2024-10-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("100","211486","6953395502342","0","18","0","8949","2027-05-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("101","865691","6008879066688","0","3","0","5199","2025-11-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("102","168251","6033000101983","0","11","0","9582","2026-08-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("103","346223","6033000102669","0","4","0","9582","2024-10-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("104","112131","6156000046105","0","13","0","9582","2026-09-08","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("105","686902","6154000295042","0","3","0","8949","2026-06-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("106","537858","537858","0","4","0","7818","2026-07-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("107","847724","847724","0","22","0","7600","2028-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("108","507571","507571","0","38","0","7600","0028-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("109","476595","476595","0","66","0","9189","2028-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("110","445301","445301","0","3","0","4850","2026-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("111","911036","911036","0","3","0","4850","2026-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("112","318341","318341","0","3","0","8949","2027-11-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("113","954903","954903","0","3","0","8949","2025-05-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("114","231283","231283","0","4","0","8949","2027-01-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("115","957306","6151006000335","0","5","0","3452","2025-05-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("116","113723","113723","0","2","0","3452","2024-12-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("117","311547","6156000052335","0","3","0","3452","2026-02-28","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("118","518579","608887011265","0","90","0","2935","2028-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("119","495355","608887011241","0","90","0","2935","2028-08-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("120","141743","8908002671797","0","60","0","7818","2025-05-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("121","331688","8908002671445","0","40","0","7818","2025-02-28","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("122","286280","8850769020236","0","29","0","7818","2024-02-05","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("123","631241","6152110057468","0","100","0","7818","2026-07-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("124","100811","6034000231434","0","11","0","7818","2025-02-28","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("125","609392","6093926955273083417","0","1","0","7818","2025-08-07","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("126","220586","2205868850769014884","0","2","0","7818","","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("127","610518","610518653468571591","0","1","0","7818","2025-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("128","918105","918105","0","4","0","7818","2026-06-03","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("129","263862","8908002671018","0","1","0","7818","2024-08-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("130","726904","5021265247783","0","1","0","7818","2024-12-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("131","270093","270093","0","1","0","7818","2025-08-06","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("132","954608","6156000262703","0","4","0","7818","2025-10-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("133","696120","608887048865","0","1","0","7818","2025-12-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("134","515475","6156000132686","0","2","0","2684","2024-02-29","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("135","657541","657541","0","3","0","8019","2025-09-21","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("136","947721","8906001820499","0","1","0","2935","2026-03-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("137","242341","8906001820499","0","1","0","2935","2026-05-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("138","502953","8901040397070","0","2","0","2935","2025-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("139","622848","01189060456097051726033110ECT230054214NXG5NHE92892C","0","3","0","2935","2026-03-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("140","775931","705632601662","0","3","0","2935","2025-11-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("141","429800","429800","0","1","0","2935","2024-07-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("142","438325","8904054615253","0","4","0","2935","2026-02-28","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("143","516304","011890420890115417102200763-121CHFKA0000802J","0","4","0","2935","2026-10-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("144","780357","780357","0","2","0","2935","2026-04-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("145","757476","GTIN.18906045627907","0","10","0","2935","2025-01-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("146","866864","8908002671131","0","2","0","7818","2025-07-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("147","859557","8908002671032","0","3","0","7818","2025-07-23","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("148","856906","856906","0","8","0","7818","2026-07-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("149","354958","6154000033064","0","3","0","1149","2024-10-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("150","627210","6154000240080","0","1","0","2220","2025-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("151","301373","6156000132686","0","2","0","1149","2024-02-28","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("152","867379","867379","0","3","0","1149","2025-09-21","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("153","682728","070125989252","0","2","0","1149","2026-06-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("154","366712","6034000140859","0","4","0","7094","2025-07-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("155","850739","6034000140521","0","5","0","7094","2025-07-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("156","421687","6034000140514","0","4","0","7094","2025-05-20","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("157","808901","6034000140842","0","7","0","7094","2025-04-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("158","697254","6156000045641","0","5","0","7094","2025-02-28","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("159","633244","633244","0","1","0","7094","2025-01-29","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("160","206295","206295","0","1","0","7094","2024-09-01","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("161","150429","6154000034108","0","1","0","7094","2025-06-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("162","548300","608887011678","0","3","0","7094","2025-07-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("163","135434","135434","0","2","0","7094","2026-11-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("164","909875","909875","0","2","0","7094","2026-10-10","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("165","762843","762843","0","1","0","7094","2026-04-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("166","238588","238588","0","3","0","7094","2026-09-27","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("167","861193","6156000081397","0","7","0","7094","2025-10-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("168","589026","6154000295004","0","5","0","7094","2026-07-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("169","830387","6154000034146","0","4","0","7094","2025-04-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("170","250181","6156000067636","0","3","0","7094","2026-05-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("171","570478","6154000056001","0","4","0","7094","2026-10-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("172","945095","945095","0","3","0","7094","0026-02-12","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("173","186252","6154000033354","0","2","0","8019","2026-06-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("174","250841","9556100101327","0","3","0","8019","2025-06-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("175","265736","6154000295141","0","1","0","8019","2025-06-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("176","369428","9556100101327","0","3","0","8019","2025-06-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("177","517409","6154000273002","0","1","0","8019","2025-02-28","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("178","829420","829420","0","4","0","2684","2025-12-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("179","307776","307776","0","1","0","2684","2025-03-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("180","948437","948437","0","5","0","8019","","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("181","644548","644548","0","2","0","2684","2025-08-03","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("182","459312","6154000240110","0","3","0","1149","2025-12-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("183","723549","608887011401","0","3","0","1149","2026-06-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("184","466024","6154000072070","0","2","0","1149","2025-05-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("185","132663","615100600328","0","6","0","8949","2025-04-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("186","699939","6156000300429","0","3","0","4506","2026-01-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("187","555266","01189060092382241724083110B1ALQ028210BP1XALA4186239AME","0","1","0","4702","2024-08-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("188","986907","6151006000281","0","3","0","2220","2025-02-28","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("189","572953","572953","0","2","0","4702","2026-05-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("190","727953","6154000240134","0","1","0","7569","2026-06-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("191","505212","608887011234","0","3","0","2684","2026-07-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("192","146865","6151006000328","0","6","0","8949","2025-04-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("193","290447","290447","0","10","0","4975","2026-04-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("194","338720","338720","0","11","0","4975","2027-11-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("195","465901","8906035499111","0","8","0","4975","2024-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("196","809459","6940999101019","0","9","0","4975","2025-02-28","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("197","993805","8906009238180","0","7","0","4975","2025-10-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("198","548911","8906044913172","0","9","0","4975","2025-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("199","495294","495294","0","8","0","4975","2025-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("200","502776","8906044919112","0","10","0","4975","2024-12-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("201","412491","608887011364","0","5","0","7271","2026-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("202","656355","8904159414362","0","4","0","3681","2025-11-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("203","426073","426073","0","4","0","7271","2023-10-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("204","294311","8904159402420","0","4","0","3681","2026-03-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("205","245013","01189041803011641725060010212421SEX3N7TMFXBU7KNVPY","0","5","0","7271","2025-06-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("206","864706","8904181403891","0","5","0","7271","2024-12-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("207","903119","903119","0","1","0","3681","2024-08-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("208","147439","147439","0","3","0","7271","2025-08-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("209","605231","605231","0","4","0","7271","","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("210","879856","879856","0","5","0","3681","2024-11-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("211","285838","6034000140767","0","2","0","7271","","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("212","690409","690409","0","4","0","3681","2024-03-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("213","784961","784961","0","3","0","3681","2024-12-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("214","299881","299881","0","3","0","3681","2025-01-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("215","402667","8906088660186","0","18","0","1970","2026-11-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("216","217349","6156000152660","0","8","0","3681","2025-01-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("217","294249","8656020962242","0","13","0","1970","2026-06-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("218","879873","6159000248821","0","3","0","7271","2504-11-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("219","781241","781241","0","29","0","3681","0026-06-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("220","731026","0108902292004594","0","2","0","7818","2026-01-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("221","372990","372990","0","3","0","3681","2024-02-29","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("222","616426","8902292604589","0","60","0","7818","2025-02-28","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("223","659348","659348","0","190","0","3681","2026-06-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("224","696752","696752","0","50","0","8949","2027-04-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("225","510685","510685","0","162","0","8949","2025-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("226","204141","608455342333","0","50","0","8949","2024-05-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("227","885632","00050024200016GC","0","24","0","8949","2027-02-28","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("228","356406","356406","0","11","0","8949","2026-08-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("229","608686","UDIA115","0","10","0","4210","2024-12-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("230","470200","8906016710587","0","10","0","8949","2027-05-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("231","331934","331934","0","60","0","4210","2027-01-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("232","973598","973598","0","60","0","4210","2026-08-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("233","176240","176240","0","146","0","8949","2025-12-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("234","354285","8699809010239","0","30","0","4210","2024-12-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("235","569352","569352","0","50","0","2935","2025-10-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("236","871069","6156000152653","0","9","0","7271","2026-03-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("237","865897","865897","0","20","0","2935","2026-12-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("238","981448","6156000152646","0","10","0","7271","2025-11-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("239","991250","991250","0","70","0","2935","2026-05-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("240","394280","6902654101000","0","40","0","2935","2025-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("241","195012","01189060456286451021GT248172157673C9291A74038A2","0","80","0","6543","2024-07-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("242","198506","6154000040239","0","928","0","7271","2026-11-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("243","787770","787770","0","80","0","6543","2025-07-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("244","302312","8906078112763","0","22","0","6543","2025-05-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("245","376893","376893","0","28","0","7271","2024-09-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("246","144321","144321","0","1","0","7333","2027-10-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("247","137745","01189020310115691725053110AC220122A21S0RPM605H5BE","0","60","0","1834","2505-05-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("248","973279","973279","0","10","0","7333","2027-04-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("249","171305","01189060461309941724070010B706","0","26","0","8949","2024-07-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("250","387098","18906047651139GREATLIGHT MISOPROSTOL","0","3","0","1970","2024-12-31","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("251","893488","893488","0","1","0","2935","2026-05-30","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("252","185130","185130","0","40","0","7818","","stock in","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("253","252305","893488","FLEMING 1000 MG","0","1","2935","default","product sales","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("254","252305","6154000033002","EMZOR PARACETAMOL TAB","0","30","1834","default","product sales","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("255","252305","8906044913172","COATAL- FORTE SOFT GEL","0","1","4975","default","product sales","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("256","252305","8656020962242","BACK-UP","0","1","1970","default","product sales","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("257","252305","6154000136024","VITACLOX - AMPICLOX","0","20","2935","default","product sales","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("258","252305","507571","SYRING 2ML","0","1","7600","default","product sales","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("259","252305","580292","P.T STRIP","0","1","8949","default","product sales","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("260","252305","01189060461309941724070010B706","PHINIMOTIL","0","1","8949","default","product sales","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("261","252305","0118906045620533","G. ORAL","0","1","8949","default","product sales","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("262","252305","787770","LORATADINE 10MG","0","10","6543","default","product sales","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("263","252305","185130","VITAMIN C  TABS","0","40","7818","default","product sales","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("264","252305","6154000033064","FIMIN SYRUP","0","1","1149","default","product sales","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("265","252305","8906044919112","UPXIN ANTIMALARIA SOFTGEL","0","1","4975","default","product sales","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("266","252305","705632601662","SIPROSAN","0","1","2935","default","product sales","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("267","252305","6154000077303","TETRACYCLINE 250MG - FIDSON","0","10","2935","default","product sales","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("268","252305","8995858187558","MIXAGRIP","0","4","6543","default","product sales","processed","20010701","2024-02-14");
INSERT INTO product_movement_log VALUES("269","222487","5017007023364","0","10","0","9022","2028-02-28","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("270","902371","8906001822035","0","3","0","2935","2025-12-31","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("271","579955","6151006000489","0","9","0","4975","2025-02-28","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("272","955052","6151006000052","0","6","0","2935","2026-01-31","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("273","872133","6156000067643","0","5","0","1149","2026-11-30","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("274","413432","01189060092382241724083110B1ALQ028210BP1XALA4186239AME","P-ALAXIN SUP","5","0","4702","2024-11-30","product update","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("275","151990","608887011616","0","4","0","7094","2026-09-30","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("276","518586","6940999101019","ARTEQUICK ARTHEMETER 375MG","5","0","4975","2025-02-28","product update","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("277","295589","6156000351438","0","20","0","9526","2026-04-30","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("278","100327","01189060092356741724113010B1ALM072210BP1202A13368300X6U","0","5","0","2684","2024-11-30","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("279","969152","969152","0","3","0","8019","2025-08-30","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("280","740478","8906001820499","CIPROTAB  500MG/BY14","3","0","2935","2026-03-31","product update","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("281","951219","6154000033163","0","10","0","1834","2028-04-30","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("282","459893","ULOR35","0","10","0","6543","2025-10-31","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("283","374220","8906045943727","0","3","0","2684","2024-03-30","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("284","888047","6156000045801","0","5","0","2684","2025-10-31","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("285","894694","8904185704161","0","5","0","2935","2025-08-30","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("286","552968","8901296107546","0","2","0","2684","2025-02-28","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("287","184318","8904159402444","0","2","0","2684","2025-07-30","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("288","230263","8906044919839","0","6","0","7818","2025-10-30","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("289","125360","6009679832510","0","1","0","9582","2027-05-02","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("290","623306","372990","NORMORETIC","10","0","3681","2024-08-31","product update","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("291","306930","8470007491279","0","20","0","7818","2026-09-30","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("292","192604","8906047362625","0","3","0","7818","2024-10-31","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("293","216172","8906047362632","0","9","0","7818","2024-10-30","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("294","440180","8901040250078","0","3","0","2935","2025-08-30","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("295","184525","8906044911062","0","1","0","7818","2026-07-30","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("296","557012","9784000000000","0","3","0","9801","2026-07-30","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("297","342677","5017007023371","0","10","0","9022","2028-03-31","stock in","processed","20010701","2024-02-15");
INSERT INTO product_movement_log VALUES("298","495730","6154000033002","EMZOR PARACETAMOL TAB","0","10","1834","default","product sales","processed","20120252","2024-02-15");
INSERT INTO product_movement_log VALUES("299","495730","507571","SYRING 2ML","0","1","7600","default","product sales","processed","20120252","2024-02-15");
INSERT INTO product_movement_log VALUES("300","495730","376893","GREENTOL","0","2","7271","default","product sales","processed","20120252","2024-02-15");
INSERT INTO product_movement_log VALUES("301","495730","8906044913172","COATAL- FORTE SOFT GEL","0","1","4975","default","product sales","processed","20120252","2024-02-15");
INSERT INTO product_movement_log VALUES("302","495730","6034000140521","TUXIL- N ADULTS EXPECTORANT","0","1","7094","default","product sales","processed","20120252","2024-02-15");
INSERT INTO product_movement_log VALUES("303","495730","787770","LORATADINE 10MG","0","10","6543","default","product sales","processed","20120252","2024-02-15");
INSERT INTO product_movement_log VALUES("304","495730","8901296108284","BRUSTAN-N 400MG","0","10","1834","default","product sales","processed","20120252","2024-02-15");
INSERT INTO product_movement_log VALUES("305","824545","01189060092356741724113010B1ALM072210BP1202A13368300X6U","LONART 20/120","0","1","2684","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("306","824545","6156000132686","DRUPROFEN SUSPENSION","0","1","1149","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("307","824545","510685","SHALTOUX","0","6","8949","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("308","203633","376893","GREENTOL","0","2","7271","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("309","203633","608887011265","CO-TRIMOXAZOLE","0","1","2935","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("310","203633","510685","SHALTOUX","0","1","8949","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("311","520452","6154000077396","METRONE 400MG","0","10","2935","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("312","520452","6161105661986","EXTRA PANADOL","0","10","1834","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("313","520452","608887011241","CO-TRIMOXAZOLE 480ML","0","1","2935","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("314","520452","510685","SHALTOUX","0","4","8949","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("315","520452","113723","ALBENDAZOLE TAB AXEITOL","0","1","3452","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("316","520452","867379","VEMFEN ORAL SUSPENSION 100MG/5ML","0","1","1149","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("317","599906","372990","NORMORETIC","0","1","3681","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("318","599906","8906009232225","LOFNAC 100MG","0","10","1834","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("319","599906","5017007023371","AMLODIPINE 10 MG","0","1","9022","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("320","599906","781241","VASOPRIN CARDI PROTECTIVE","0","1","3681","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("321","299495","6151006000229","M&B PARACETAMOL Tab","17","0","1834","2028-08-30","product update","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("322","696359","6151006000229","0","17","0","1834","2028-08-30","stock in","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("323","513625","513625","0","20","0","8949","","stock in","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("325","591520","8906009238180","LONART -DS","0","1","4975","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("326","591520","6151006000229","M&B PARACETAMOL TAB","0","1","1834","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("327","591520","8906009238180","LONART -DS","0","1","4975","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("328","591520","8906001820499","CIPROTAB  500MG/BY14","0","1","2935","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("329","591520","6971161600191","SUREX NIGHT","0","1","1834","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("330","591520","608887011241","CO-TRIMOXAZOLE 480ML","0","1","2935","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("331","591520","156959","BG PARACETAMOL INJECTION","0","1","7333","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("332","591520","847724","SYRING 5ML","0","1","7600","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("333","591520","6151006000229","M&B PARACETAMOL TAB","0","1","1834","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("334","902063","242341","CIPROTAB  500MG/BY10","0","1","2935","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("335","906110","0118906045620533","G. ORAL","0","1","8949","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("336","500077","8906016710587","KISS","0","1","8949","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("337","500077","6154000040239","DANACID","0","1","7271","default","product sales","processed","20120252","2024-02-16");
INSERT INTO product_movement_log VALUES("338","381256","6151006000489","ARTELUM COMBO 80/480 TABS","0","1","4975","default","product sales","processed","20120252","2024-02-17");
INSERT INTO product_movement_log VALUES("339","381256","6151006000052","M&B CIPRO 500 BY 14","0","1","2935","default","product sales","processed","20120252","2024-02-17");
INSERT INTO product_movement_log VALUES("340","381256","6154000077365","METRONE 200MG","0","1","2935","default","product sales","processed","20120252","2024-02-17");
INSERT INTO product_movement_log VALUES("341","381256","6154000033064","FIMIN SYRUP","0","1","1149","default","product sales","processed","20120252","2024-02-17");
INSERT INTO product_movement_log VALUES("342","381256","225450","METOCLOPRAMIDE INJECTION","0","1","7333","default","product sales","processed","20120252","2024-02-17");
INSERT INTO product_movement_log VALUES("343","381256","156959","BG PARACETAMOL INJECTION","0","1","7333","default","product sales","processed","20120252","2024-02-17");
INSERT INTO product_movement_log VALUES("344","381256","507571","SYRING 2ML","0","2","7600","default","product sales","processed","20120252","2024-02-17");
INSERT INTO product_movement_log VALUES("345","381256","847724","SYRING 5ML","0","1","7600","default","product sales","processed","20120252","2024-02-17");
INSERT INTO product_movement_log VALUES("346","103401","690409","AMLODIPINE 5MG -(EDEN)","0","1","3681","default","product sales","processed","20120252","2024-02-17");
INSERT INTO product_movement_log VALUES("347","413032","8901296108284","BRUSTAN-N 400MG","0","1","1834","default","product sales","processed","20120252","2024-02-17");
INSERT INTO product_movement_log VALUES("348","834999","608887011241","CO-TRIMOXAZOLE 480ML","0","1","2935","default","product sales","processed","20120252","2024-02-17");
INSERT INTO product_movement_log VALUES("349","158400","158400","0","20","0","8949","","stock in","processed","20010701","2024-02-17");
INSERT INTO product_movement_log VALUES("350","748102","748102","0","10","0","7784","2025-01-13","stock in","processed","20010701","2024-08-24");
INSERT INTO product_movement_log VALUES("351","537644","748102","RANGOLISE WATER","0","1","7784","default","product sales","processed","20010701","2024-08-24");
INSERT INTO product_movement_log VALUES("352","575819","748102","RANGOLISE WATER","0","1","7784","default","product sales","processed","20010701","2024-08-24");
INSERT INTO product_movement_log VALUES("353","488824","748102","RANGOLISE WATER","0","1","7784","default","product sales","processed","20010701","2024-08-24");
INSERT INTO product_movement_log VALUES("354","653137","748102","RANGOLISE WATER","20","0","7784","2025-01-24","product update","processed","20010701","2024-08-24");



CREATE TABLE `sales` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `prod_id` varchar(255) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `cashier` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `cash` varchar(100) NOT NULL,
  `pos` varchar(100) NOT NULL,
  `transfer` varchar(100) NOT NULL,
  `bank` varchar(55) NOT NULL,
  `pos_medium` varchar(55) NOT NULL,
  `client_id` varchar(55) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `discount` varchar(55) NOT NULL,
  `total_payment` varchar(55) NOT NULL,
  `client_name` varchar(55) NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_id` varchar(55) NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

INSERT INTO sales VALUES("1","","468369","buchi","2024-02-13","550","0","0","","","0","550","0","0","550","WALK-IN-CLIENT","SUPPLIED","20010701");
INSERT INTO sales VALUES("2","630138","424562","buchi","2024-02-13","150","0","0","","","0","150","0","0","150","WALK-IN-CLIENT","SUPPLIED","20010701");
INSERT INTO sales VALUES("3","627625","252305","buchi","2024-02-14","8050","0","5800","","","0","13850","0","0","13850","WALK-IN-CLIENT","SUPPLIED","20010701");
INSERT INTO sales VALUES("4","636066","495730","dorcas","2024-02-15","200","0","2750","","","0","2950","0","0","2950","WALK-IN-CLIENT","SUPPLIED","20120252");
INSERT INTO sales VALUES("5","859557","169618","RAPHA","2024-02-15","0","3100","0","","","0","3100","0","0","3100","WALK-IN-CLIENT","NOT SUPPLIED","20160225");
INSERT INTO sales VALUES("6","718562","354840","RAPHA","2024-02-15","1000","0","0","","","0","950","-50","0","1000","WALK-IN-CLIENT","NOT SUPPLIED","20160225");
INSERT INTO sales VALUES("7","651718","939986","RAPHA","2024-02-15","0","3250","0","","","0","3250","0","0","3250","WALK-IN-CLIENT","NOT SUPPLIED","20160225");
INSERT INTO sales VALUES("8","375863","976793","RAPHA","2024-02-15","1000","0","0","","","0","300","-700","0","1000","WALK-IN-CLIENT","NOT SUPPLIED","20160225");
INSERT INTO sales VALUES("9","393735","287223","RAPHA","2024-02-15","0","1650","0","","","0","1650","0","0","1650","WALK-IN-CLIENT","NOT SUPPLIED","20160225");
INSERT INTO sales VALUES("10","919971","924888","RAPHA","2024-02-15","500","0","0","","","0","500","0","0","500","WALK-IN-CLIENT","NOT SUPPLIED","20160225");
INSERT INTO sales VALUES("11","301373","824545","dorcas","2024-02-16","0","0","5000","","","0","5000","0","0","5000","WALK-IN-CLIENT","SUPPLIED","20120252");
INSERT INTO sales VALUES("12","510685","203633","dorcas","2024-02-16","750","0","0","","","0","750","0","0","750","WALK-IN-CLIENT","SUPPLIED","20120252");
INSERT INTO sales VALUES("13","","520452","dorcas","2024-02-16","1500","0","0","","","0","1500","0","0","1500","WALK-IN-CLIENT","SUPPLIED","20120252");
INSERT INTO sales VALUES("14","781241","599906","dorcas","2024-02-16","1150","0","0","","","0","1150","0","0","1150","WALK-IN-CLIENT","SUPPLIED","20120252");
INSERT INTO sales VALUES("16","","591520","dorcas","2024-02-16","9500","0","0","","","0","9500","0","0","9500","WALK-IN-CLIENT","SUPPLIED","20120252");
INSERT INTO sales VALUES("17","242341","902063","dorcas","2024-02-16","2800","0","0","","","0","2800","0","0","2800","WALK-IN-CLIENT","SUPPLIED","20120252");
INSERT INTO sales VALUES("18","","906110","dorcas","2024-02-16","150","0","0","","","0","150","0","0","150","WALK-IN-CLIENT","SUPPLIED","20120252");
INSERT INTO sales VALUES("19","198506","500077","dorcas","2024-02-16","300","0","0","","","0","300","0","0","300","WALK-IN-CLIENT","SUPPLIED","20120252");
INSERT INTO sales VALUES("20","847724","381256","dorcas","2024-02-17","3150","0","0","","","0","3150","0","0","3150","WALK-IN-CLIENT","SUPPLIED","20120252");
INSERT INTO sales VALUES("21","690409","103401","dorcas","2024-02-17","250","0","0","","","0","250","0","0","250","WALK-IN-CLIENT","SUPPLIED","20120252");
INSERT INTO sales VALUES("22","636066","413032","dorcas","2024-02-17","300","0","0","","","0","300","0","0","300","WALK-IN-CLIENT","SUPPLIED","20120252");
INSERT INTO sales VALUES("23","","834999","dorcas","2024-02-17","200","0","0","","","0","200","0","0","200","WALK-IN-CLIENT","SUPPLIED","20120252");
INSERT INTO sales VALUES("24","748102","537644","buchi","2024-08-24","150","0","0","","","0","150","0","0","150","WALK-IN-CLIENT","SUPPLIED","20010701");
INSERT INTO sales VALUES("25","748102","575819","buchi","2024-08-24","150","0","0","","","0","150","0","0","150","WALK-IN-CLIENT","SUPPLIED","20010701");
INSERT INTO sales VALUES("26","748102","488824","buchi","2024-08-24","150","0","0","","","0","150","0","0","150","WALK-IN-CLIENT","SUPPLIED","20010701");



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
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=latin1;

INSERT INTO sales_order VALUES("6","468369","UANO06","10","550","ANOROL (HOVID)","55","0","1834","2024-02-13","70","0","processed");
INSERT INTO sales_order VALUES("8","432895","8904210707259","10","1000","NO ACH","100","0","1834","2024-02-13","30","0","pending");
INSERT INTO sales_order VALUES("9","424562","6161105660286","1","150","ANDREWS LIVER SALT","150","0","7271","2024-02-13","67","0","processed");
INSERT INTO sales_order VALUES("10","312132","6154000033002","1","15","EMZOR PARACETAMOL TAB","15","0","1834","2024-02-14","119","0","pending");
INSERT INTO sales_order VALUES("11","948379","6154000033002","10","150","EMZOR PARACETAMOL TAB","15","0","1834","2024-02-14","110","0","pending");
INSERT INTO sales_order VALUES("12","613509","6154000033002","10","150","EMZOR PARACETAMOL TAB","15","0","1834","2024-02-14","110","0","pending");
INSERT INTO sales_order VALUES("14","421737","6151006000366","10","1000","LOXAGYL 200 MG","100","0","2935","2024-02-14","20","0","pending");
INSERT INTO sales_order VALUES("29","252305","893488","1","5800","FLEMING 1000 MG","5800","0","2935","2024-02-14","0","0","processed");
INSERT INTO sales_order VALUES("30","252305","6154000033002","30","450","EMZOR PARACETAMOL TAB","15","0","1834","2024-02-14","90","0","processed");
INSERT INTO sales_order VALUES("31","252305","8906044913172","1","1500","COATAL- FORTE SOFT GEL","1500","0","4975","2024-02-14","8","0","processed");
INSERT INTO sales_order VALUES("32","252305","8656020962242","1","650","BACK-UP","650","0","1970","2024-02-14","12","0","processed");
INSERT INTO sales_order VALUES("35","252305","6154000136024","20","900","VITACLOX - AMPICLOX","45","0","2935","2024-02-14","50","0","processed");
INSERT INTO sales_order VALUES("36","252305","507571","1","50","SYRING 2ML","50","0","7600","2024-02-14","37","0","processed");
INSERT INTO sales_order VALUES("37","252305","580292","1","100","P.T STRIP","100","0","8949","2024-02-14","49","0","processed");
INSERT INTO sales_order VALUES("38","252305","01189060461309941724070010B706","1","100","PHINIMOTIL","100","0","8949","2024-02-14","25","0","processed");
INSERT INTO sales_order VALUES("39","252305","0118906045620533","1","150","G. ORAL","150","0","8949","2024-02-14","7","0","processed");
INSERT INTO sales_order VALUES("40","252305","787770","10","100","LORATADINE 10MG","10","0","6543","2024-02-14","70","0","processed");
INSERT INTO sales_order VALUES("41","252305","185130","40","200","VITAMIN C  TABS","5","0","7818","2024-02-14","0","0","processed");
INSERT INTO sales_order VALUES("42","252305","6154000033064","1","500","FIMIN SYRUP","500","0","1149","2024-02-14","2","0","processed");
INSERT INTO sales_order VALUES("43","252305","8906044919112","1","1650","UPXIN ANTIMALARIA SOFTGEL","1650","0","4975","2024-02-14","9","0","processed");
INSERT INTO sales_order VALUES("44","252305","705632601662","1","1200","SIPROSAN","1200","0","2935","2024-02-14","2","0","processed");
INSERT INTO sales_order VALUES("45","252305","6154000077303","10","200","TETRACYCLINE 250MG - FIDSON","20","0","2935","2024-02-14","160","0","processed");
INSERT INTO sales_order VALUES("46","252305","8995858187558","4","300","MIXAGRIP","75","0","6543","2024-02-14","160","0","processed");
INSERT INTO sales_order VALUES("47","364286","8904181403891","1","400","RBCARE 20MG","400","0","7271","2024-02-14","4","0","pending");
INSERT INTO sales_order VALUES("49","467960","5017007023364","1","550","AMLODIPINE 5MG - TEVA","550","0","9022","2024-02-15","9","0","pending");
INSERT INTO sales_order VALUES("50","495730","6154000033002","10","150","EMZOR PARACETAMOL TAB","15","0","1834","2024-02-15","80","0","processed");
INSERT INTO sales_order VALUES("51","495730","507571","1","50","SYRING 2ML","50","0","7600","2024-02-15","36","0","processed");
INSERT INTO sales_order VALUES("52","495730","376893","2","200","GREENTOL","100","0","7271","2024-02-15","26","0","processed");
INSERT INTO sales_order VALUES("53","495730","8906044913172","1","1500","COATAL- FORTE SOFT GEL","1500","0","4975","2024-02-15","7","0","processed");
INSERT INTO sales_order VALUES("54","495730","6034000140521","1","650","TUXIL- N ADULTS EXPECTORANT","650","0","7094","2024-02-15","4","0","processed");
INSERT INTO sales_order VALUES("55","495730","787770","10","100","LORATADINE 10MG","10","0","6543","2024-02-15","60","0","processed");
INSERT INTO sales_order VALUES("56","495730","8901296108284","10","300","BRUSTAN-N 400MG","30","0","1834","2024-02-15","590","0","processed");
INSERT INTO sales_order VALUES("57","104353","8906078112763","1","100","CHLORFED TABS 4MG","100","0","6543","2024-02-15","21","0","pending");
INSERT INTO sales_order VALUES("60","584809","8906044919839","3","2250","DARAVIT","750","0","7818","2024-02-15","3","0","pending");
INSERT INTO sales_order VALUES("61","169618","8908002671032","1","3100","ASTYMIN SYRUP","3100","0","7818","2024-02-15","2","0","pending");
INSERT INTO sales_order VALUES("62","354840","ULOR35","1","600","LORATYN-10 (HOVID)","600","0","6543","2024-02-15","9","0","pending");
INSERT INTO sales_order VALUES("63","354840","6161105661986","10","350","EXTRA PANADOL","35","0","1834","2024-02-15","60","0","pending");
INSERT INTO sales_order VALUES("64","939986","537858","1","600","NEMEL VITAMIN C TABS 100MG","600","0","7818","2024-02-15","3","0","pending");
INSERT INTO sales_order VALUES("66","939986","6156000127552","1","1100","BETADRONE-N","1100","0","8807","2024-02-15","2","0","pending");
INSERT INTO sales_order VALUES("67","939986","ULOR35","1","600","LORATYN-10 (HOVID)","600","0","6543","2024-02-15","9","0","pending");
INSERT INTO sales_order VALUES("68","939986","5285001820764","3","600","SOFTWAVE WHITE TISSUE","200","0","8949","2024-02-15","3","0","pending");
INSERT INTO sales_order VALUES("69","939986","UCLO107","10","350","CLOFENAC 50MG (HOVID)","35","0","1834","2024-02-15","150","0","pending");
INSERT INTO sales_order VALUES("70","976793","6154000033002","20","300","EMZOR PARACETAMOL TAB","15","0","1834","2024-02-15","60","0","pending");
INSERT INTO sales_order VALUES("71","287223","991250","10","750","EDEN FLUCONAZOLE 200MG","75","0","2935","2024-02-15","60","0","pending");
INSERT INTO sales_order VALUES("72","287223","8904185502804","20","900","AMOXICILLIN - OLIMOX 500MG","45","0","2935","2024-02-15","100","0","pending");
INSERT INTO sales_order VALUES("73","924888","6971161600191","10","200","SUREX NIGHT","20","0","1834","2024-02-15","330","0","pending");
INSERT INTO sales_order VALUES("74","924888","8995858999991","4","300","PROCOLD","75","0","6543","2024-02-15","48","0","pending");
INSERT INTO sales_order VALUES("75","478331","01189060092356741724113010B1ALM072210BP1202A13368300X6U","1","2100","LONART 20/120","2100","0","2684","2024-02-16","4","0","pending");
INSERT INTO sales_order VALUES("76","478331","6156000132686","1","600","DRUPROFEN SUSPENSION","600","0","1149","2024-02-16","1","0","pending");
INSERT INTO sales_order VALUES("77","478331","011890420890332517241100102200890-1210MF28LLA46691XM5-1210MF28LLA46691XM5","1","2000","AMOXILLIN -SUP MEDICLAV","2000","0","2684","2024-02-16","2","0","pending");
INSERT INTO sales_order VALUES("78","478331","510685","6","300","SHALTOUX","50","0","8949","2024-02-16","156","0","pending");
INSERT INTO sales_order VALUES("79","598010","011890420890332517241100102200890-1210MF28LLA46691XM5-1210MF28LLA46691XM5","1","2000","AMOXILLIN -SUP MEDICLAV","2000","0","2684","2024-02-16","2","0","pending");
INSERT INTO sales_order VALUES("80","598010","6156000132686","1","600","DRUPROFEN SUSPENSION","600","0","1149","2024-02-16","1","0","pending");
INSERT INTO sales_order VALUES("81","598010","01189060092356741724113010B1ALM072210BP1202A13368300X6U","1","2100","LONART 20/120","2100","0","2684","2024-02-16","4","0","pending");
INSERT INTO sales_order VALUES("83","598010","510685","6","300","SHALTOUX","50","0","8949","2024-02-16","156","0","pending");
INSERT INTO sales_order VALUES("84","824545","011890420890332517241100102200890-1210MF28LLA46691XM5-1210MF28LLA46691XM5","1","2000","AMOXILLIN -SUP MEDICLAV","2000","0","2684","2024-02-16","2","0","processed");
INSERT INTO sales_order VALUES("85","824545","01189060092356741724113010B1ALM072210BP1202A13368300X6U","1","2100","LONART 20/120","2100","0","2684","2024-02-16","4","0","processed");
INSERT INTO sales_order VALUES("86","824545","6156000132686","1","600","DRUPROFEN SUSPENSION","600","0","1149","2024-02-16","1","0","processed");
INSERT INTO sales_order VALUES("87","824545","510685","6","300","SHALTOUX","50","0","8949","2024-02-16","156","0","processed");
INSERT INTO sales_order VALUES("88","203633","376893","2","200","GREENTOL","100","0","7271","2024-02-16","24","0","processed");
INSERT INTO sales_order VALUES("89","203633","608887011265","1","500","CO-TRIMOXAZOLE","500","0","2935","2024-02-16","89","0","processed");
INSERT INTO sales_order VALUES("90","203633","510685","1","50","SHALTOUX","50","0","8949","2024-02-16","155","0","processed");
INSERT INTO sales_order VALUES("92","520452","6154000077396","10","150","METRONE 400MG","15","0","2935","2024-02-16","320","0","processed");
INSERT INTO sales_order VALUES("93","520452","6161105661986","10","350","EXTRA PANADOL","35","0","1834","2024-02-16","60","0","processed");
INSERT INTO sales_order VALUES("94","520452","608887011241","1","200","CO-TRIMOXAZOLE 480ML","200","0","2935","2024-02-16","89","0","processed");
INSERT INTO sales_order VALUES("95","520452","510685","4","200","SHALTOUX","50","0","8949","2024-02-16","151","0","processed");
INSERT INTO sales_order VALUES("96","520452","113723","1","150","ALBENDAZOLE TAB AXEITOL","150","0","3452","2024-02-16","1","0","processed");
INSERT INTO sales_order VALUES("97","520452","867379","1","450","VEMFEN ORAL SUSPENSION 100MG/5ML","450","0","1149","2024-02-16","2","0","processed");
INSERT INTO sales_order VALUES("99","987180","5017007023371","1","600","AMLODIPINE 10 MG","600","0","9022","2024-02-16","9","0","pending");
INSERT INTO sales_order VALUES("100","599906","372990","1","300","NORMORETIC","300","0","3681","2024-02-16","12","0","processed");
INSERT INTO sales_order VALUES("102","599906","8906009232225","10","200","LOFNAC 100MG","20","0","1834","2024-02-16","20","0","processed");
INSERT INTO sales_order VALUES("103","599906","5017007023371","1","600","AMLODIPINE 10 MG","600","0","9022","2024-02-16","9","0","processed");
INSERT INTO sales_order VALUES("104","599906","781241","1","50","VASOPRIN CARDI PROTECTIVE","50","0","3681","2024-02-16","28","0","processed");
INSERT INTO sales_order VALUES("107","947083","6161105661986","1","350","EXTRA PANADOL","350","0","1834","2024-02-16","4","0","pending");
INSERT INTO sales_order VALUES("109","282611","969152","1","2500","ABIDEC GOUTTES 25ML DROP","2500","0","8019","2024-02-16","2","0","pending");
INSERT INTO sales_order VALUES("110","396149","969152","1","2500","ABIDEC GOUTTES 25ML DROP","2500","0","8019","2024-02-16","2","0","pending");
INSERT INTO sales_order VALUES("112","591520","8906009238180","1","2650","LONART -DS","2650","0","4975","2024-02-16","6","0","processed");
INSERT INTO sales_order VALUES("113","591520","6151006000229","1","150","M&B PARACETAMOL TAB","150","0","1834","2024-02-16","16","0","processed");
INSERT INTO sales_order VALUES("114","591520","8906009238180","1","2650","LONART -DS","2650","0","4975","2024-02-16","6","0","processed");
INSERT INTO sales_order VALUES("115","591520","8906001820499","1","3350","CIPROTAB  500MG/BY14","3350","0","2935","2024-02-16","3","0","processed");
INSERT INTO sales_order VALUES("116","591520","6971161600191","1","200","SUREX NIGHT","200","0","1834","2024-02-16","32","0","processed");
INSERT INTO sales_order VALUES("117","591520","608887011241","1","200","CO-TRIMOXAZOLE 480ML","200","0","2935","2024-02-16","88","0","processed");
INSERT INTO sales_order VALUES("118","591520","156959","1","100","BG PARACETAMOL INJECTION","100","0","7333","2024-02-16","92","0","processed");
INSERT INTO sales_order VALUES("119","591520","847724","1","50","SYRING 5ML","50","0","7600","2024-02-16","21","0","processed");
INSERT INTO sales_order VALUES("120","591520","6151006000229","1","150","M&B PARACETAMOL TAB","150","0","1834","2024-02-16","16","0","processed");
INSERT INTO sales_order VALUES("122","902063","242341","1","2800","CIPROTAB  500MG/BY10","2800","0","2935","2024-02-16","2","0","processed");
INSERT INTO sales_order VALUES("123","675871","969152","1","2500","ABIDEC GOUTTES 25ML DROP","2500","0","8019","2024-02-16","2","0","pending");
INSERT INTO sales_order VALUES("127","500077","8906016710587","1","200","KISS","200","0","8949","2024-02-16","9","0","processed");
INSERT INTO sales_order VALUES("128","500077","6154000040239","1","100","DANACID","100","0","7271","2024-02-16","115","0","processed");
INSERT INTO sales_order VALUES("129","877721","6151006000489","1","1200","ARTELUM COMBO 80/480 TABS","1200","0","4975","2024-02-17","8","0","pending");
INSERT INTO sales_order VALUES("130","877721","6151006000052","1","1000","M&B CIPRO 500 BY 14","1000","0","2935","2024-02-17","5","0","pending");
INSERT INTO sales_order VALUES("131","877721","6154000077365","1","100","METRONE 200MG","100","0","2935","2024-02-17","24","0","pending");
INSERT INTO sales_order VALUES("132","877721","6154000033064","1","500","FIMIN SYRUP","500","0","1149","2024-02-17","1","0","pending");
INSERT INTO sales_order VALUES("133","877721","225450","1","100","METOCLOPRAMIDE INJECTION","100","0","7333","2024-02-17","20","0","pending");
INSERT INTO sales_order VALUES("134","381256","6151006000489","1","1200","ARTELUM COMBO 80/480 TABS","1200","0","4975","2024-02-17","8","0","processed");
INSERT INTO sales_order VALUES("135","381256","6151006000052","1","1000","M&B CIPRO 500 BY 14","1000","0","2935","2024-02-17","5","0","processed");
INSERT INTO sales_order VALUES("136","381256","6154000077365","1","100","METRONE 200MG","100","0","2935","2024-02-17","24","0","processed");
INSERT INTO sales_order VALUES("137","381256","6154000033064","1","500","FIMIN SYRUP","500","0","1149","2024-02-17","1","0","processed");
INSERT INTO sales_order VALUES("138","381256","225450","1","100","METOCLOPRAMIDE INJECTION","100","0","7333","2024-02-17","20","0","processed");
INSERT INTO sales_order VALUES("139","381256","156959","1","100","BG PARACETAMOL INJECTION","100","0","7333","2024-02-17","91","0","processed");
INSERT INTO sales_order VALUES("140","381256","507571","2","100","SYRING 2ML","50","0","7600","2024-02-17","34","0","processed");
INSERT INTO sales_order VALUES("141","381256","847724","1","50","SYRING 5ML","50","0","7600","2024-02-17","20","0","processed");
INSERT INTO sales_order VALUES("142","103401","690409","1","250","AMLODIPINE 5MG -(EDEN)","250","0","3681","2024-02-17","3","0","processed");
INSERT INTO sales_order VALUES("143","413032","8901296108284","1","300","BRUSTAN-N 400MG","300","0","1834","2024-02-17","4","0","processed");
INSERT INTO sales_order VALUES("144","733092","608887011241","1","200","CO-TRIMOXAZOLE 480ML","200","0","2935","2024-02-17","87","0","pending");
INSERT INTO sales_order VALUES("145","834999","608887011241","1","200","CO-TRIMOXAZOLE 480ML","200","0","2935","2024-02-17","87","0","processed");
INSERT INTO sales_order VALUES("147","537644","748102","1","150","RANGOLISE WATER","150","0","7784","2024-08-24","9","0","processed");
INSERT INTO sales_order VALUES("148","575819","748102","1","150","RANGOLISE WATER","150","0","7784","2024-08-24","8","0","processed");
INSERT INTO sales_order VALUES("149","488824","748102","1","150","RANGOLISE WATER","150","0","7784","2024-08-24","7","0","processed");



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

INSERT INTO update_product VALUES("1","653137","Bulk Update","2024-08-24","20010701");



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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO update_product_order VALUES("1","653137","748102","RANGOLISE WATER","20","0","7784","product update","processed","20010701","2025-01-24","2024-08-24");



CREATE TABLE `update_product_price_list` (
  `ref_id` int NOT NULL AUTO_INCREMENT,
  `update_product_id` varchar(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` varchar(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO update_product_price_list VALUES("1","839937","Bulk Update Price list","2024-08-24","20010701");



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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO update_product_price_list_order VALUES("1","839937","748102","RANGOLISE WATER","150","200","WATER","2024-08-24");



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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO users VALUES("1","20010701","BUCHI DANIEL","buchi","c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec","07033433535","Existing User","1","admin","2023-07-12","1268");
INSERT INTO users VALUES("10","20120252","DORCAS","dorcas","22086982656bd9abc82ca8d597fde88c35590e920fa997c39ec0199426af188028d362b438cd08d2630bc11d5535b4e0888a6c8ec3af6a3acb1a1991b86173c1","08069163310","Existing User","1","admin","2024-02-15","1111");
INSERT INTO users VALUES("11","20160225","SANI RAPHA TACHIO","RAPHA","b43adaa02c66225f7e98511536e044b8425d3080f17421d110fb09490ab0868984fbfe9eed0344763f0e3e6fbe9a5a6457ca42db88fb8cdf6243de4af503c683","08168580236","Existing User","1","cashier","2024-02-15","1111");
INSERT INTO users VALUES("12","20140209","DAN","dan","d404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db","08069163310","New User","1","cashier","2024-02-16","1111");



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


