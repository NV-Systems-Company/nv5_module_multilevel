<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2021 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Fri, 03 Dec 2021 06:49:21 GMT
 */

if (!defined('NV_IS_FILE_MODULES'))
    die('Stop!!!');

$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_agency";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_bonuses";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_city";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_customer";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_customers";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_depot";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_discounts";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_groups_customer";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_importproduct";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_importproduct_history";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_money";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_orders";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_orders_id";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_orders_id_out";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_possiton";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_product";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_saleoff";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_statistic";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_street";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_transaction";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_users";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_usersbk";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_ward";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_warehouse_logs";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_warehouse_order";

$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_agency(
  id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  alias varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  image varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '',
  price_require float DEFAULT '0',
  number_sale smallint(4) NOT NULL DEFAULT '0' COMMENT 'Số lượng sản phẩm mua sẽ được tặng',
  number_gift smallint(4) NOT NULL DEFAULT '0' COMMENT 'Số lượng sẽ được tặng',
  price_for_discount float NOT NULL DEFAULT '0' COMMENT 'Số tiền để đc chiết khấu',
  price_discount float NOT NULL COMMENT 'tiền chiết khấu',
  description text COLLATE utf8mb4_unicode_ci,
  bodytext mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  keywords text COLLATE utf8mb4_unicode_ci,
  weight smallint(4) NOT NULL DEFAULT '0',
  add_time int(11) NOT NULL DEFAULT '0',
  edit_time int(11) NOT NULL DEFAULT '0',
  status tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  UNIQUE KEY alias (alias)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_bonuses(
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  percent float NOT NULL DEFAULT '0' COMMENT '% thưởng khi đạt định mức',
  percent_from float NOT NULL DEFAULT '0' COMMENT '% vượt từ',
  percent_to float NOT NULL DEFAULT '0' COMMENT '% vượt đến',
  weight smallint(4) NOT NULL DEFAULT '0',
  status tinyint(4) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_city(
  city_id mediumint(8) NOT NULL AUTO_INCREMENT,
  title varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  alias varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  weight mediumint(8) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) unsigned NOT NULL DEFAULT '0',
  area tinyint(1) unsigned NOT NULL DEFAULT '0',
  important tinyint(1) unsigned NOT NULL DEFAULT '0',
  type varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (city_id),
  UNIQUE KEY alias (alias)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_customer(
  cid int(11) NOT NULL AUTO_INCREMENT,
  cuscode varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  companyid int(11) NOT NULL DEFAULT '0',
  title varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  gid int(11) NOT NULL DEFAULT '0',
  address varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  mobile varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  fax varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  email varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  taxcode varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  person_legal varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  person_legal_mobile varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  vi_note text COLLATE utf8mb4_unicode_ci NOT NULL,
  en_note varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  weight int(11) NOT NULL DEFAULT '0',
  active int(1) NOT NULL,
  adminid int(11) NOT NULL,
  crtd_date int(11) NOT NULL,
  userid_edit int(11) NOT NULL,
  update_date int(11) NOT NULL,
  status_del int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (cid),
  UNIQUE KEY cuscode (cuscode)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_customers(
  customer_id mediumint(8) unsigned NOT NULL,
  refer_userid mediumint(8) unsigned NOT NULL COMMENT 'Nguoi gioi thieu',
  code varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  fullname varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  address varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  phone varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  email varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  description text COLLATE utf8mb4_unicode_ci,
  add_time int(11) NOT NULL DEFAULT '0',
  edit_time int(11) NOT NULL DEFAULT '0',
  custype tinyint(1) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_depot(
  id smallint(6) unsigned NOT NULL,
  userid mediumint(8) unsigned NOT NULL,
  title varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  address varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  mobile varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  addtime int(10) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_discounts(
  id smallint(6) NOT NULL,
  productid int(10) unsigned NOT NULL DEFAULT '0',
  add_time int(11) unsigned NOT NULL DEFAULT '0',
  begin_quantity int(10) unsigned NOT NULL DEFAULT '0',
  end_quantity int(10) unsigned NOT NULL DEFAULT '0',
  percent float unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_district(
  id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  idprovince mediumint(8) unsigned NOT NULL DEFAULT '0',
  title varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_groups_customer(
  id int(11) NOT NULL AUTO_INCREMENT,
  code varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  title varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  note text COLLATE utf8mb4_unicode_ci NOT NULL,
  weight int(11) NOT NULL DEFAULT '0',
  active int(1) NOT NULL,
  adminid int(11) NOT NULL,
  crtd_date int(11) NOT NULL,
  userid_edit int(11) NOT NULL,
  time_update int(11) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_importproduct(
  iid int(11) NOT NULL,
  customerid int(11) unsigned NOT NULL,
  title varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  note text COLLATE utf8mb4_unicode_ci NOT NULL,
  addtime int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_importproduct_history(
  iid int(11) unsigned NOT NULL DEFAULT '0',
  productid int(11) unsigned NOT NULL DEFAULT '0',
  quantity int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'SL SP nhap kho',
  totalprice float NOT NULL DEFAULT '0' COMMENT 'So tien da nhap'
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs(
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  desctiption text COLLATE utf8mb4_unicode_ci,
  weight smallint(4) NOT NULL DEFAULT '0',
  status tinyint(4) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_money(
  userid mediumint(8) unsigned NOT NULL,
  money_in double NOT NULL,
  money_out double NOT NULL,
  money double NOT NULL,
  status tinyint(4) NOT NULL,
  PRIMARY KEY (userid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_orders(
  order_id int(11) unsigned NOT NULL,
  customer_id mediumint(8) unsigned NOT NULL,
  order_code varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  order_name varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  order_email varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  order_phone varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  order_address varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  order_note text COLLATE utf8mb4_unicode_ci NOT NULL,
  user_id int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'ID tuyến trên',
  admin_id int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'ID người xác nhận đặt hàng',
  order_total double NOT NULL DEFAULT '0',
  order_time int(11) unsigned NOT NULL DEFAULT '0',
  edit_time int(11) unsigned NOT NULL DEFAULT '0',
  postip varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  saleoff float NOT NULL DEFAULT '0' COMMENT 'tiền chiết khấu',
  feeship double NOT NULL DEFAULT '0' COMMENT 'Phi ship hang',
  price_payment double NOT NULL DEFAULT '0' COMMENT 'Tien da thanh toan',
  shipcode tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Ship COD',
  showadmin tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Đơn hàng của 1=NV CTY',
  chossentype tinyint(4) NOT NULL COMMENT 'Kiểu nhập hàng 1: cho mình, 2 cho ĐL dưới cấp, 3 khách lẻ',
  ordertype tinyint(4) NOT NULL DEFAULT '1' COMMENT '1: Nhập hàng, 0: trả hàng',
  orderid_refer int(11) NOT NULL DEFAULT '0' COMMENT 'ID đơn hàng khi trả',
  amount_refunded double NOT NULL DEFAULT '0' COMMENT 'Số tiền còn sau khi trả hàng',
  depotid smallint(6) NOT NULL,
  status tinyint(4) NOT NULL,
  time_payment int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_orders_id(
  id int(11) unsigned NOT NULL,
  order_id int(11) NOT NULL,
  proid mediumint(9) NOT NULL,
  num mediumint(9) NOT NULL,
  type_return tinyint(4) NOT NULL COMMENT '1 bị hỏng, 2 k bán được',
  numreturn mediumint(9) NOT NULL DEFAULT '0' COMMENT 'SP tra',
  price int(11) NOT NULL,
  num_out int(10) unsigned NOT NULL DEFAULT '0',
  num_com int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'SL cty sẽ xuất	',
  isgift tinyint(3) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_orders_id_out(
  id int(11) unsigned NOT NULL,
  order_id int(11) NOT NULL,
  proid mediumint(9) NOT NULL,
  num_out int(10) unsigned NOT NULL DEFAULT '0',
  timeout int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_possiton(
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  alias varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  image varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '',
  weight smallint(4) NOT NULL DEFAULT '0',
  percent_responsibility float NOT NULL DEFAULT '0' COMMENT '% chiết khấu trách nhiệm quản lý cả hệ thống cấp dưới',
  salary float NOT NULL DEFAULT '0' COMMENT 'Mức lương',
  kpi_require float NOT NULL DEFAULT '0' COMMENT 'KPI để được hưởng lương',
  istype tinyint(4) NOT NULL COMMENT 'Loại vị trí - hưởng % doanh thu hay lợi nhuận',
  status tinyint(4) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_product(
  id mediumint(8) unsigned NOT NULL,
  catid int(11) NOT NULL DEFAULT '0',
  productshopid int(11) NOT NULL COMMENT 'ID sp tai module shops',
  unit smallint(4) NOT NULL,
  pnumber int(11) NOT NULL DEFAULT '0',
  pnumberout int(11) NOT NULL DEFAULT '0',
  addtime int(11) unsigned NOT NULL DEFAULT '0',
  edittime int(11) unsigned NOT NULL DEFAULT '0',
  priceshow tinyint(4) NOT NULL DEFAULT '0',
  status tinyint(4) NOT NULL DEFAULT '1',
  code varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  title varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  alias varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  image varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  price_in float DEFAULT '0' COMMENT 'gia nhap',
  price_retail float DEFAULT '0' COMMENT 'gia ban le',
  price_wholesale float DEFAULT '0' COMMENT 'gia ban si',
  weight smallint(6) NOT NULL DEFAULT '0'
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province(
  id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_saleoff(
  id smallint(4) unsigned NOT NULL,
  salesfrom double DEFAULT '0' COMMENT 'doanh thu tu',
  salesto double DEFAULT '0' COMMENT 'doanh thu den',
  moneyrequire float DEFAULT '0' COMMENT 'số tiền thỏa mãn đk',
  status tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Trạng thái'
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_statistic(
  customer_id mediumint(8) unsigned NOT NULL,
  monthyear int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Doanh thu tháng nào',
  total_price float NOT NULL DEFAULT '0' COMMENT 'So tien'
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_street(
  street_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  city_id mediumint(8) unsigned NOT NULL DEFAULT '0',
  district_id mediumint(8) unsigned NOT NULL DEFAULT '0',
  title varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  type varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  location varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  weight mediumint(8) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (street_id),
  UNIQUE KEY city_id_district_id_title (city_id,district_id,title)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_transaction(
  id int(11) NOT NULL AUTO_INCREMENT,
  createdtime int(11) NOT NULL,
  transaction_type tinyint(4) NOT NULL,
  money double NOT NULL,
  userid int(11) NOT NULL,
  postid int(11) NOT NULL,
  module_name varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  transaction_info text COLLATE utf8mb4_unicode_ci NOT NULL,
  transaction_data text COLLATE utf8mb4_unicode_ci NOT NULL,
  status tinyint(4) NOT NULL,
  PRIMARY KEY (id),
  KEY userid (userid),
  KEY createdtime (createdtime)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_users(
  userid smallint(5) unsigned NOT NULL,
  username varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  fullname varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  email varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  parentid smallint(5) unsigned NOT NULL DEFAULT '0',
  usernameparent varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  precode varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tiền tố mã nhân viên',
  code varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Mã nhân viên',
  domain varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  mobile varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  peopleid varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  salary_day float NOT NULL DEFAULT '0',
  benefit float DEFAULT NULL,
  numbercard varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  banknumber varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  photo_befor varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  photo_after varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  daterange varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  issuedby varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  address varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  numcardtype tinyint(4) NOT NULL DEFAULT '0',
  datatext text COLLATE utf8mb4_unicode_ci,
  weight smallint(5) unsigned NOT NULL DEFAULT '0',
  sort smallint(5) NOT NULL DEFAULT '0',
  lev smallint(5) NOT NULL DEFAULT '0',
  possitonid smallint(6) NOT NULL,
  agencyid smallint(6) NOT NULL,
  istype tinyint(4) NOT NULL,
  numsubcat smallint(5) NOT NULL DEFAULT '0',
  subcatid text COLLATE utf8mb4_unicode_ci,
  listparentid text COLLATE utf8mb4_unicode_ci NOT NULL,
  add_time int(11) unsigned NOT NULL DEFAULT '0',
  edit_time int(11) unsigned NOT NULL DEFAULT '0',
  status tinyint(4) unsigned NOT NULL DEFAULT '0',
  wardid int(11) NOT NULL DEFAULT '0',
  provinceid smallint(6) NOT NULL DEFAULT '0',
  districtid smallint(6) NOT NULL DEFAULT '0',
  permission tinyint(3) unsigned NOT NULL,
  haveorder tinyint(4) DEFAULT '0' COMMENT 'Có đơn hàng trên hệ thống chưa',
  shareholder tinyint(3) unsigned NOT NULL DEFAULT '0',
  deviceid varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  jobid int(10) unsigned DEFAULT '0',
  pendingdelete int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Thời gian chờ xóa',
  ishidden tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0 không ẩn, 1 ẩn trên sơ đồ cây',
  affiliate_code varchar(259) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  UNIQUE KEY userid (userid),
  UNIQUE KEY precode (precode),
  UNIQUE KEY code (code),
  KEY haveorder (haveorder)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_usersbk(
  userid int(11) NOT NULL,
  username varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  useridcat int(11) NOT NULL DEFAULT '0',
  usernamecat varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (userid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_ward(
  ward_id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  district_id mediumint(8) unsigned NOT NULL DEFAULT '0',
  city_id mediumint(8) unsigned NOT NULL DEFAULT '0',
  title varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  alias varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  type varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  location varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  weight mediumint(8) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (ward_id),
  UNIQUE KEY alias_district_id_city_id (alias)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_warehouse_logs(
  customerid int(11) unsigned NOT NULL DEFAULT '0',
  depotid smallint(6) NOT NULL,
  productid int(11) unsigned NOT NULL DEFAULT '0',
  quantity_in int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'SL SP trong kho',
  price_in float NOT NULL DEFAULT '0' COMMENT 'So tien thu duoc',
  quantity_out int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'SL SP da ban',
  price_out float NOT NULL DEFAULT '0' COMMENT 'So tien da nhap',
  quantity_com int(10) unsigned NOT NULL DEFAULT '0',
  KEY customerid (customerid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_warehouse_order(
  customerid int(11) unsigned NOT NULL DEFAULT '0',
  depotid smallint(6) NOT NULL,
  productid int(11) unsigned NOT NULL DEFAULT '0',
  orderid int(11) unsigned NOT NULL DEFAULT '0',
  quantity_befor int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'SL trc nhap-xuat',
  quantity_in int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'SL nhập',
  price_in float NOT NULL DEFAULT '0' COMMENT 'So tien thu duoc',
  quantity_after int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'SL sau nhap-xuat',
  quantity_out int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'SL ban',
  price_out float NOT NULL DEFAULT '0' COMMENT 'So tien da nhap',
  addtime int(11) unsigned NOT NULL DEFAULT '0',
  KEY customerid (customerid)
) ENGINE=MyISAM";
